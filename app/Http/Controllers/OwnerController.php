<?php

namespace App\Http\Controllers;

use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemOwner;
use App\Models\User\User;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareModel;
use App\Models\Hardware\HardwareOwner;
use App\Models\Hardware\HardwareType;
use App\Models\Material\Material;
use App\Models\Material\MaterialOwner;
use App\Models\Software\Software;
use App\Models\Software\SoftwareOwner;
use Illuminate\Http\Request;
use App\Models\Transaction\Transaction;
use PDF;

class OwnerController extends Controller
{
    //Zimmet Ana Sayfa
        public function owner(Request $request,$id)
        {
            $user = User::find($id);
            return view("front.owner.main",compact('user'));
        }
    //Zimmet Ekleme
        public function owner_create(Request $request,$id)
        {
            $user       =   User::find($id);
            return view("front.owner.create",compact('user'));
        }
        public function owner_create_result(Request $request)
        {
            dd($request->all());
            if($control>0){
                Transaction::insert(['admin_name'=>$request->session()->get('name'),'user_name'=>$user->name,'user_email'=>$user->email,'trans_type'=>'Donanım Atama','hard_bn'=>$item->bn,'hard_sn'=>$item->sn,'hard_type'=>$item->getType->name,'hard_detail'=>$item->detail,'created_at'=>now()]);
                return redirect()->route("owner",['id'=>$request->id])->withCookie(cookie('success', 'Donanım Atama Başarılı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->id])->withCookie(cookie('error', 'Donanım Atama Başarısız!',0.02));

            }
        }
    //ZİMMET İADE
        public function hardware_drop(Request $request){
            $control = HardwareOwner::where('hardware_id',$request->hardware_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $hardware = Hardware::where('id',$request->hardware_id)->first();
                Transaction::insert([
                    'type_id'=> 2,
                    'user_id'=>$user->id,
                    'admin_name'=>$request->session()->get('name'),
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>'Barkod No: '.$hardware->barcode_number.' Seri No: '.$hardware->serial_number,
                    'trans_details'=>$hardware->detail,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Donanım İade İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Donanım İade İşlemi Başarısız',0.02));

            }
        }
        public function software_drop(Request $request){
            $control = SoftwareOwner::where('software_id',$request->software_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $software = Software::find($request->software_id);
                Transaction::insert([
                    'type_id'=> 4,
                    'user_id'=>$user->id,
                    'admin_name'=>$request->session()->get('name'),
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$software->name,
                    'trans_details'=>$software->getType->name,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Yazılım İade İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Yazılım İade İşlemi Başarısız',0.02));

            }
        }
        public function common_drop(Request $request){
            $control = CommonItemOwner::where('common_item_id',$request->common_item_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $common = CommonItem::find($request->common_item_id);
                CommonItem::where('id',$common->id)->update([
                    'owner_count' => $common->owner_count-1
                ]);
                Transaction::insert([
                    'type_id'=> 8,
                    'user_id'=>$user->id,
                    'admin_name'=>$request->session()->get('name'),
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$common->name,
                    'trans_details'=>$common->getType->name,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Ortak Kullanımdan Çıkartıldı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Ortak Kullanım Çıkartma İşlemi Başarısız!',0.02));

            }
        }
        public function material_drop(Request $request){
            $control = MaterialOwner::where('material_id',$request->material_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $material = Material::find($request->material_id);
                Transaction::insert([
                    'type_id'=> 6,
                    'user_id'=>$user->id,
                    'admin_name'=>$request->session()->get('name'),
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$material->name,
                    'trans_details'=>$material->getType->name,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Malzeme İade İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Malzeme İade İşlemi Başarısız',0.02));

            }
        }
    //Tablolar İçin Ajax Sorguları
        public function owner_hardware_table_ajax(Request $request){
            $hardwares = HardwareOwner::where('owner_id',$request->id)->get();
            foreach($hardwares as $hardware){
                $hardware->type         =   $hardware->getInfo->getType->name;
                $hardware->model        =   $hardware->getInfo->getModel->name;
                $hardware->issue_time   =   createTurkishDate($hardware->created_at);
            }
            $data['hardwares'] = $hardwares;
            return response()->json($data);
        }
        public function owner_software_table_ajax(Request $request){
            $softwares = SoftwareOwner::where('owner_id',$request->id)->get();
            foreach($softwares as $software){
                $software->type             =   $software->getInfo->getType->name;
                $software->issue_time       =   createTurkishDate($software->created_at);
                $software->start_time_show  =   createTurkishDate($software->getInfo->start_time);
                $software->finish_time_show =   createTurkishDate($software->getInfo->finish_time);
            }
            $data['softwares'] = $softwares;
            return response()->json($data);
        }
        public function owner_common_table_ajax(Request $request){
            $commons = CommonItemOwner::where('owner_id',$request->id)->get();
            foreach($commons as $common){
                $common->type         =   $common->getInfo->getType->name;
                $common->issue_time   =   createTurkishDate($common->created_at);
            }
            $data['commons'] = $commons;
            return response()->json($data);
        }
        public function owner_material_table_ajax(Request $request){
            $materials = MaterialOwner::where('owner_id',$request->id)->get();
            foreach($materials as $material){
                $material->type         =   $material->getInfo->getType->name;
                $material->issue_time   =   createTurkishDate($material->created_at);
            }
            $data['materials'] = $materials;
            return response()->json($data);
        }
    //Zimmet Seçimleri İçin Ajax Sorguları
        public function get_useable_hardware(Request $request){
            if(isset($request->search)){
                $search = "%".$request->search."%";
                $useable_hardware = Hardware::select('hardware.id as id','hardware.barcode_number','hardware.serial_number','hardware_type.name as type','hardware_model.name as model','detail')
                ->leftJoin("hardware_owner","hardware_owner.hardware_id","=","hardware.id")
                ->leftJoin("hardware_type","hardware_type.id","=","hardware.type_id")
                ->leftJoin("hardware_model","hardware_model.id","=","hardware.model_id")
                ->whereNull('owner_id')
                ->where(function($query) use ($search){
                    $query->where('barcode_number','like',$search)
                    ->orWhere('serial_number','like',$search)
                    ->orWhere('hardware_type.name','like',$search)
                    ->orWhere('hardware_model.name','like',$search);
                })->get();
                if(count($useable_hardware)>0){
                    foreach($useable_hardware as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        /*$text = "Tür: ".$item->type
                        ." Model: ".$item->model
                        .$item->barcode_number."(Seri No: ".$item->serial_number.")";*/
                        $text = "<b>$item->type</b>";
                        $html = "<div><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Model:</u></b> $item->model</span></br>
                        <span><b><u>Barkod No:</u></b> $item->barcode_number($item->serial_number)</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></br></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html,
                            'detail' => $item->detail
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
            else{
                $hardware = Hardware::select('hardware.id as id','hardware.barcode_number','hardware.serial_number','hardware_type.name as type','hardware_model.name as model','detail')
                ->leftJoin("hardware_owner","hardware_owner.hardware_id","=","hardware.id")
                ->leftJoin("hardware_type","hardware_type.id","=","hardware.type_id")
                ->leftJoin("hardware_model","hardware_model.id","=","hardware.model_id")->limit(5)->get();
                if(count($hardware)>0){
                    foreach($hardware as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        /*$text = "Tür: ".$item->type."\n"
                        ."Model: ".$item->model."\n"
                        .$item->barcode_number."(Seri No: ".$item->serial_number.")";*/
                        $text = "<b>$item->type</b>";
                        $html = "<div><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Model:</u></b> $item->model</span></br>
                        <span><b><u>Barkod No:</u></b> $item->barcode_number($item->serial_number)</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></br></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html,
                            'detail' => $item->detail
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
        }
        public function hardware_create_ajax (Request $request){
            //KONTROL
                if($request->new_type && $request->new_type_prefix){
                    $type = HardwareType::where('name',$request->new_type)->orWhere('prefix',$request->new_type_prefix)->first();
                    if($type){
                        $data['error'] = "Tip Adı ve ya Tip Ön Eki Kullanılıyor!";
                        return response()->json($data);
                    }
                    $prefix = $request->new_type_prefix;
                }
                else{
                    $type =   HardwareType::find($request->type_id);
                    if($type==NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                    $prefix = $type->prefix;
                }
                if($request->new_model){
                    $model = HardwareModel::where('name',$request->new_model)->first();
                    if($model){
                        $data['error'] = "Bu Model Zaten Mevcut!";
                        return response()->json($data);
                    }
                }
                else{
                    $model = HardwareModel::find($request->model_id);
                    if($model==NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
                if($request->barcode_number){
                    $barcode_number = $prefix.$request->barcode_number;
                    $control    =   Hardware::where('barcode_number',$barcode_number)->count();
                    if($control>0){
                        $data['error'] = "Barkod Numarası Kullanılıyor!";
                        return response()->json($data);
                    }
                }
                if(isset($request->serial_number)){
                    $control    =   Hardware::where('serial_number',$request->serial_number)->count();
                    if($control>0){
                        $data['error'] = "Seri Numarası Kullanılıyor!";
                        return response()->json($data);
                    }
                }
            //Donanım Ekleme
            $get_detail = trim($request->detail);
            $get_detail = explode(PHP_EOL,$get_detail);
            $detail='';
            for($i=0;$i<count($get_detail);$i++){
                if($i != (count($get_detail)-1)){
                    $detail .=  $get_detail[$i].'\n';
                }
                else{
                    $detail .=  $get_detail[$i];
                }
            }
            if($request->new_type && $request->new_type_prefix){
                HardwareType::insert(['name'=> $request->new_type,'prefix' => $request->new_type_prefix,'created_at' => now(),'updated_at' => now()]);
                if(!isset($request->barcode_number)){
                    $barcode_number = $request->new_type_prefix.'1';
                }
                else{
                    $barcode_number = $request->new_type_prefix.$request->barcode_number;
                }
                $type = HardwareType::orderByDesc('id')->first();
                $type_id = $type->id;
                $data['type'] = array('id'=>$type->id,'prefix'=>$type->prefix,'text'=>$type->name);
            }
            else{
                $type_id = $request->type_id;
                $prefix = HardwareType::find($request->type_id)->prefix;
                if(!isset($request->barcode_number)){
                    $hardwares = Hardware::where('type_id',$request->type_id)->get();
                    $i=1;
                    for($j=0;$j<count($hardwares);$j++){
                        $craft = $prefix.$i;
                        $like = '%'.$craft.'%';
                        $control = Hardware::where('barcode_number','like',$like)->first();
                        if($control == NULL){
                            $barcode_number = $craft;
                            break;
                        }
                        else{
                            $i++;
                        }
                    }
                    if(!isset($barcode_number)){
                        $barcode_number =$prefix.$i;
                    }
                }
                else{
                    $barcode_number = $prefix.$request->barcode_number;
                }
            }
            if($request->new_model){
                HardwareModel::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                $model = HardwareModel::orderByDesc('id')->first();
                $model_id = $model->id;
                $data['model'] = array('id'=>$model_id,'text'=>$model->name);
            }
            else{
                $model_id = $request->model_id;
            }
            $control        =   Hardware::insert([
                'barcode_number'=>$barcode_number,
                'serial_number'=>$request->serial_number,
                'type_id'=>$type_id,
                'model_id'=>$model_id,
                'detail'=>$detail,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
            if($control>0){
                $item = Hardware::orderByDesc('id')->first();
                $type = $item->getType->name;
                $data['id'] = $item->id;
                $data['text'] ="<b>$type</b>";
                return response()->json($data);
            }
            else{
                $data['error'] = "Donanım Ekleme Sırasında Hata!";
                return response()->json($data);            }
        }
    //Zimmet Fişi
        public function owner_pdf($id){
            $user               =   User::find($id);
            $items              =   Owner::where('id',$id)->get();
            $i=1;
            foreach($items as $item){
                $item->type     =   $item->getType->name;
                $item->detail   =   $item->getDetail->detail;
                $item->sn       =   $item->getDetail->sn;
                $item->id    =   $i;
                $i++;
            }
            return view('front.owner.pdf',compact('items','user'));
        }
}
