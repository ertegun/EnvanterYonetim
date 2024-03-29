<?php

namespace App\Http\Controllers;

use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemOwner;
use App\Models\CommonItem\CommonItemType;
use App\Models\User\User;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareModel;
use App\Models\Hardware\HardwareOwner;
use App\Models\Hardware\HardwareType;
use App\Models\Material\Material;
use App\Models\Material\MaterialOwner;
use App\Models\Material\MaterialType;
use App\Models\Software\Software;
use App\Models\Software\SoftwareOwner;
use App\Models\Software\SoftwareType;
use Illuminate\Http\Request;
use App\Models\Transaction\Transaction;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleOwner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    //Kullanıcı Zimmet Yönetimi Ana Sayfa
        public function owner(Request $request,$id)
        {
            $user = User::find($id);
            return view("front.owner.main",compact('user'));
        }
    //Kullanıcıya Zimmet Ekleme Sayfası
        public function owner_create(Request $request,$id)
        {
            $user       =   User::find($id);
            return view("front.owner.create",compact('user'));
        }
    //Seçili Zimmetleri Kullanıcıya Ekleme
        public function owner_create_result(Request $request)
        {
            $user = User::find($request->user_id);
            $issue_time_stamp = strtotime($request->issue_time);
            $issue_time = date('Y-m-d H:i:s',$issue_time_stamp);
            if(isset($request->hardwares)){
                foreach($request->hardwares as $item){
                    $control = HardwareOwner::insert(['hardware_id' => $item,'owner_id' => $user->id,'created_at' => $issue_time]);
                    if($control){
                        $hardware = Hardware::where('id',$item)->first();
                        $trans_info = 'Tür: '.$hardware->getType->name.
                        '  Barkod No: '.$hardware->barcode_number;
                        if($hardware->detail != NULL){
                            $trans_details = str_replace('\\n','  ',$hardware->detail);
                            if(strlen($hardware->detail) > 30){
                                $trans_details = str_split($trans_details,28);
                                $trans_details = $trans_details[0]."...";
                            }
                        }
                        else{
                            $trans_details = "Yok";
                        }
                        Transaction::insert([
                            'type_id' => 1,
                            'user_id' => $user->id,
                            'admin_name' => Auth::user()->name,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'trans_info' => $trans_info,
                            'trans_details' => $trans_details,
                            'created_at' => $issue_time
                        ]);
                    }
                    else{
                        return redirect()->route('owner_create',['id'=>$request->id])->withCookie(cookie('error', 'Zimmet Atama İşlemi Başarısız!',0.02));
                    }
                }
            }
            if(isset($request->softwares)){
                foreach($request->softwares as $item){
                    $control = SoftwareOwner::insert(['software_id' => $item,'owner_id' => $user->id,'created_at' => $issue_time]);
                    if($control){
                        $software = Software::find($item);
                        $trans_info = 'Tür: '.$software->getType->name.
                        '  Yazılım Adı: '.$software->name;
                        if($software->finish_time){
                            $finish_time = createTurkishDate($software->finish_time);
                        }
                        else{
                            $finish_time = 'Süresiz';
                        }
                        $trans_details = 'Bitiş Tarihi: '.$finish_time;
                        Transaction::insert([
                            'type_id' => 3,
                            'user_id' => $user->id,
                            'admin_name' => Auth::user()->name,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'trans_info' => $trans_info,
                            'trans_details' => $trans_details,
                            'created_at' => $issue_time
                        ]);
                    }
                    else{
                        return redirect()->route('owner_create',['id'=>$request->id])->withCookie(cookie('error', 'Zimmet Atama İşlemi Başarısız!',0.02));
                    }
                }
            }
            if(isset($request->commons)){
                foreach($request->commons as $item){
                    $control = CommonItemOwner::insert(['common_item_id' => $item,'owner_id' => $user->id,'created_at' => $issue_time]);
                    if($control){
                        $common = CommonItem::find($item);
                        $trans_info = 'Tür: '.$common->getType->name.
                        '  Ekipman Adı: '.$common->name;
                        if($common->detail != NULL){
                            $trans_details = str_replace('\\n','  ',$common->detail);
                            if(strlen($common->detail) > 30){
                                $trans_details = str_split($trans_details,28);
                                $trans_details = $trans_details[0]."...";
                            }
                        }
                        else{
                            $trans_details = "Yok";
                        }
                        Transaction::insert([
                            'type_id' => 7,
                            'user_id' => $user->id,
                            'admin_name' => Auth::user()->name,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'trans_info' => $trans_info,
                            'trans_details' => $trans_details,
                            'created_at' => $issue_time
                        ]);
                        CommonItem::where('id',$item)->update([
                            'owner_count' => $common->owner_count+1,
                            'updated_at' => now()
                        ]);
                    }
                    else{
                        return redirect()->route('owner_create',['id'=>$request->id])->withCookie(cookie('error', 'Zimmet Atama İşlemi Başarısız!',0.02));
                    }
                }
            }
            if(isset($request->materials)){
                foreach($request->materials as $item){
                    $control = MaterialOwner::insert(['material_id' => $item,'owner_id' => $user->id,'created_at' => $issue_time]);
                    if($control){
                        $material = Material::find($item);
                        if($material->detail != NULL){
                            $trans_details = str_replace('\\n','  ',$material->detail);
                            if(strlen($material->detail) > 30){
                                $trans_details = str_split($trans_details,28);
                                $trans_details = $trans_details[0]."...";
                            }
                        }
                        else{
                            $trans_details = "Yok";
                        }
                        Transaction::insert([
                            'type_id' => 5,
                            'user_id' => $user->id,
                            'admin_name' => Auth::user()->name,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'trans_info' => $material->getType->name,
                            'trans_details' => $trans_details,
                            'created_at' => $issue_time
                        ]);
                    }
                    else{
                        return redirect()->route('owner_create',['id'=>$request->id])->withCookie(cookie('error', 'Zimmet Atama(ları) İşlemi Başarısız!',0.02));
                    }
                }
            }
            if(isset($request->vehicles)){
                foreach($request->vehicles as $item){
                    $control = VehicleOwner::insert(['vehicle_id' => $item,'owner_id' => $user->id,'created_at' => $issue_time]);
                    if($control){
                        $vehicle = Vehicle::find($item);
                        if($vehicle->detail != NULL){
                            $trans_details = str_replace('\\n','  ',$vehicle->detail);
                            if(strlen($vehicle->detail) > 30){
                                $trans_details = str_split($trans_details,28);
                                $trans_details = $trans_details[0]."...";
                            }
                        }
                        else{
                            $trans_details = "Yok";
                        }
                        $trans_info = "Araç Adı: $vehicle->name".
                        "   Marka: ".$vehicle->getModel->name;
                        Transaction::insert([
                            'type_id' => 9,
                            'user_id' => $user->id,
                            'admin_name' => Auth::user()->name,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'trans_info' => $trans_info,
                            'trans_details' => $trans_details,
                            'created_at' => $issue_time
                        ]);
                    }
                    else{
                        return redirect()->route('owner_create',['id'=>$request->id])->withCookie(cookie('error', 'Zimmet Atama(ları) İşlemi Başarısız!',0.02));
                    }
                }
            }
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('success', 'Zimmet Atama(ları) Başarılı!',0.02));
        }
    //Zimmet İade
        public function hardware_drop(Request $request){
            $control = HardwareOwner::where('hardware_id',$request->hardware_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $hardware = Hardware::where('id',$request->hardware_id)->first();
                $trans_info = 'Tür: '.$hardware->getType->name.
                '  Barkod No: '.$hardware->barcode_number;
                if($hardware->detail != NULL){
                    $trans_details = str_replace('\\n','  ',$hardware->detail);
                    if(strlen($hardware->detail) > 30){
                        $trans_details = str_split($trans_details,28);
                        $trans_details = $trans_details[0]."...";
                    }
                }
                else{
                    $trans_details = "Yok";
                }
                Transaction::insert([
                    'type_id'=> 2,
                    'user_id'=>$user->id,
                    'admin_name'=>Auth::user()->name,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$trans_info,
                    'trans_details'=>$trans_details,
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
                $trans_info = 'Tür: '.$software->getType->name.
                '  Yazılım Adı: '.$software->name;
                if($software->finish_time){
                    $finish_time = createTurkishDate($software->finish_time);
                }
                else{
                    $finish_time = 'Süresiz';
                }
                $trans_details = 'Bitiş Tarihi: '.$finish_time;
                Transaction::insert([
                    'type_id'=> 4,
                    'user_id'=>$user->id,
                    'admin_name'=>Auth::user()->name,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$trans_info,
                    'trans_details'=>$trans_details,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Yazılım İade İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Yazılım İade İşlemi Başarısız',0.02));

            }
        }
        public function common_drop(Request $request){
            $control = CommonItemOwner::where('common_item_id',$request->common_item_id)
            ->where('owner_id',$request->user_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $common = CommonItem::find($request->common_item_id);
                CommonItem::where('id',$common->id)->update([
                    'owner_count' => $common->owner_count-1
                ]);
                $trans_info = 'Tür: '.$common->getType->name.
                '  Ekipman Adı: '.$common->name;
                if($common->detail != NULL){
                    $trans_details = str_replace('\\n','  ',$common->detail);
                    if(strlen($common->detail) > 30){
                        $trans_details = str_split($trans_details,28);
                        $trans_details = $trans_details[0]."...";
                    }
                }
                else{
                    $trans_details = "Yok";
                }
                Transaction::insert([
                    'type_id'=> 8,
                    'user_id'=>$user->id,
                    'admin_name'=>Auth::user()->name,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$trans_info,
                    'trans_details'=>$trans_details,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Ortak Kullanımdan Çıkartıldı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Ortak Kullanım Çıkartma İşlemi Başarısız!',0.02));

            }
        }
        public function material_drop(Request $request){
            $control = MaterialOwner::where('id',$request->id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $material = Material::find($request->material_id);
                if($material->detail != NULL){
                    $trans_details = str_replace('\\n','  ',$material->detail);
                    if(strlen($material->detail) > 30){
                        $trans_details = str_split($trans_details,28);
                        $trans_details = $trans_details[0]."...";
                    }
                }
                else{
                    $trans_details = "Yok";
                }
                Transaction::insert([
                    'type_id'=> 6,
                    'user_id'=>$user->id,
                    'admin_name'=>Auth::user()->name,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$material->getType->name,
                    'trans_details'=>$trans_details,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Malzeme İade İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Malzeme İade İşlemi Başarısız',0.02));

            }
        }
        public function vehicle_drop(Request $request){
            $control = VehicleOwner::where('vehicle_id',$request->vehicle_id)->delete();
            if($control>0){
                $user = User::find($request->user_id);
                $vehicle = Vehicle::find($request->vehicle_id);
                $trans_info = 'Araç Adı: '.$vehicle->name.
                '  Marka: '.$vehicle->getModel->name;
                if($vehicle->detail != NULL){
                    $trans_details = str_replace('\\n','  ',$vehicle->detail);
                    if(strlen($vehicle->detail) > 30){
                        $trans_details = str_split($trans_details,28);
                        $trans_details = $trans_details[0]."...";
                    }
                }
                else{
                    $trans_details = "Yok";
                }
                Transaction::insert([
                    'type_id'=> 10,
                    'user_id'=>$user->id,
                    'admin_name'=>Auth::user()->name,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'trans_info'=>$trans_info,
                    'trans_details'=>$trans_details,
                    'created_at'=>now()
                ]);
                return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Araç Teslim Alındı!',0.02));
            }
            else{
                return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Araç Teslim Alma İşlemi Başarısız!',0.02));

            }
        }
    //Tablolar İçin Ajax Sorguları
        public function owner_hardware_table_ajax(Request $request){
            $hardwares = HardwareOwner::where('owner_id',$request->id)->get();
            if($request->user()->can('isAdmin') || $request->user()->can('isIT')){
                $role= true;
            }
            else{
                $role = false;
            }
            foreach($hardwares as $hardware){
                $hardware->role         =   $role;
                $hardware->type         =   $hardware->getInfo->getType->name;
                $hardware->model        =   $hardware->getInfo->getModel->name;
                $hardware->issue_time   =   createTurkishDate($hardware->created_at);
                $hardware->issue_input  =   date('Y-m-d',strtotime($hardware->created_at));
            }
            $data['hardwares'] = $hardwares;
            return response()->json($data);
        }
        public function owner_software_table_ajax(Request $request){
            $softwares = SoftwareOwner::where('owner_id',$request->id)->get();
            if($request->user()->can('isAdmin') || $request->user()->can('isIT')){
                $role= true;
            }
            else{
                $role = false;
            }
            foreach($softwares as $software){
                $software->role             =   $role;
                $software->type             =   $software->getInfo->getType->name;
                $software->issue_time       =   createTurkishDate($software->created_at);
                $software->start_time_show  =   createTurkishDate($software->getInfo->start_time);
                $software->finish_time_show =   createTurkishDate($software->getInfo->finish_time);
                $software->issue_input      =   date('Y-m-d',strtotime($software->created_at));
            }
            $data['softwares'] = $softwares;
            return response()->json($data);
        }
        public function owner_common_table_ajax(Request $request){
            $commons = CommonItemOwner::where('owner_id',$request->id)->get();
            if($request->user()->can('isAdmin') || $request->user()->can('isIT')){
                $role= true;
            }
            else{
                $role = false;
            }
            foreach($commons as $common){
                $common->role           =   $role;
                $common->type           =   $common->getInfo->getType->name;
                $common->issue_time     =   createTurkishDate($common->created_at);
                $common->issue_input    =   date('Y-m-d',strtotime($common->created_at));
            }
            $data['commons'] = $commons;
            return response()->json($data);
        }
        public function owner_material_table_ajax(Request $request){
            if($request->user()->can('isAdmin') || $request->user()->can('isProducer')){
                $role= true;
            }
            else{
                $role = false;
            }
            $current_time = now();
            $last_month = strtotime('-1 month');
            $last_month = date('Y-m-d H:i:s',$last_month);
            $materials = MaterialOwner::where('owner_id',$request->id)
            ->whereBetween('created_at',[$last_month,$current_time])
            ->orderByDesc('created_at')
            ->get();
            foreach($materials as $material){
                $prev_issue_time = MaterialOwner::where('material_id',$material->material_id)
                ->where('created_at','<',$material->created_at)
                ->orderByDesc('created_at')->first();
                if($prev_issue_time){
                    $material->prev_issue_time = createTurkishDate($prev_issue_time->created_at);
                }
                else{
                    $material->prev_issue_time = createTurkishDate($material->created_at);
                }
                $material->type         =   $material->getInfo->getType->name;
                $material->issue_time   =   createTurkishDate($material->created_at);
                $material->issue_input  =   date('Y-m-d',strtotime($material->created_at));
                $material->role         =   $role;
            }
            $types  =   MaterialType::all();
            $i=0;
            foreach($types as $type){
                $bg_color   =   bgColors($i);

                $total_count    =   MaterialOwner::
                leftJoin("material","material.id","=","material_owner.material_id")
                ->where('material.type_id',$type->id)
                ->where('material_owner.owner_id',$request->id)
                ->count();
                if($total_count >0 ){
                    $first_issue    =   MaterialOwner::
                    select('material_owner.created_at as created_at')
                    ->leftJoin("material","material.id","=","material_owner.material_id")
                    ->where('material.type_id',$type->id)
                    ->where('material_owner.owner_id',$request->id)
                    ->orderBy('material_owner.created_at')->first()->created_at;
                    if($total_count == 1){
                        $last_issue     =   $first_issue;
                        $average_day    =   "?";
                    }
                    else{
                        $last_issue     =   MaterialOwner::
                        select('material_owner.created_at as created_at')
                        ->leftJoin("material","material.id","=","material_owner.material_id")
                        ->where('material.type_id',$type->id)
                        ->where('material_owner.owner_id',$request->id)
                        ->orderByDesc('material_owner.created_at')->first()->created_at;

                        $day_count      =   Carbon::createFromFormat('Y-m-d H:i:s',$first_issue)
                        ->diffInDays($last_issue);
                        $average_day    =   round($day_count/$total_count);
                    }
                }
                else{
                    $average_day    =   "-";
                    $total_count    =   "-";
                }

                $data['html'][] =
                "<div class='col-11 col-sm-6 col-md-4 col-xl-3'>
                    <div class='card p-1 my-3 $bg_color'>
                        <b class='text-center p-1'>$type->name</b>
                        <b class='small text-center'><u>Toplam Verilen</u></br><h5 class='text-center'> $total_count Adet</h5></b>
                        <b class='small text-center'><u>Ortalama Kullanım</u></br><h5 class='text-center'> $average_day Gün</h5></b>
                    </div>
                </div>";
                if($i==8){
                    $i=0;
                }
                else{
                    $i++;
                }
            }
            $data['materials']  =   $materials;
            return response()->json($data);
        }
        public function owner_vehicle_table_ajax(Request $request){
            $vehicles = VehicleOwner::where('owner_id',$request->id)->get();
            if($request->user()->can('isAdmin') || $request->user()->can('isProducer')){
                $role= true;
            }
            else{
                $role = false;
            }
            foreach($vehicles as $vehicle){
                $vehicle->role          =   $role;
                $vehicle->model         =   $vehicle->getInfo->getModel->name;
                $vehicle->issue_time    =   createTurkishDate($vehicle->created_at);
                $vehicle->issue_input   =   date('Y-m-d',strtotime($vehicle->created_at));
            }
            $data['vehicles'] = $vehicles;
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
                        $text = "<b>$item->type $item->barcode_number</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
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
                ->leftJoin("hardware_model","hardware_model.id","=","hardware.model_id")
                ->whereNull('owner_id')->limit(5)->get();
                if(count($hardware)>0){
                    foreach($hardware as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->type $item->barcode_number</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Model:</u></b> $item->model</span></br>
                        <span><b><u>Barkod No:</u></b> $item->barcode_number($item->serial_number)</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></div>";
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
        public function get_useable_software(Request $request){
            if(isset($request->search)){
                $search = "%".$request->search."%";
                $useable_software = Software::select('software.id as id','software.name as name','software_type.name as type','software.finish_time')
                ->leftJoin("software_owner","software_owner.software_id","=","software.id")
                ->leftJoin("software_type","software_type.id","=","software.type_id")
                ->whereNull('owner_id')
                ->where(function($query) use ($search){
                    $query->where('software.name','like',$search)
                    ->orWhere('software_type.name','like',$search);
                })->get();
                if(count($useable_software)>0){
                    foreach($useable_software as $item){
                        if($item->finish_time){
                            $finish_time = createTurkishDate($item->finish_time);
                        }
                        else{
                            $finish_time = 'Süresiz';
                        }
                        $text = "<b>$item->type</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Yazılım Adı:</u></b> $item->name</span></br>
                        <span><b><u>Bitiş Süresi:</u></b> $finish_time</span></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
            else{
                $software = Software::select('software.id as id','software.name as name','software_type.name as type','software.finish_time')
                ->leftJoin("software_owner","software_owner.software_id","=","software.id")
                ->leftJoin("software_type","software_type.id","=","software.type_id")
                ->whereNull('owner_id')->limit(5)->get();
                if(count($software)>0){
                    foreach($software as $item){
                        if($item->finish_time){
                            $finish_time = createTurkishDate($item->finish_time);
                        }
                        else{
                            $finish_time = 'Süresiz';
                        }
                        $text = "<b>$item->type</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Yazılım Adı:</u></b> $item->name</span></br>
                        <span><b><u>Bitiş Süresi:</u></b> $finish_time</span></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
        }
        public function get_useable_common_item(Request $request){
            $user_id = $request->user_id;
            if(isset($request->search)){
                $search = "%".$request->search."%";
                $useable_common_item = CommonItem::select('common_item.id as id','common_item.name as name','common_item_type.name as type','common_item.detail')
                ->leftJoin("common_item_owner","common_item_owner.common_item_id","=","common_item.id")
                ->leftJoin("common_item_type","common_item_type.id","=","common_item.type_id")
                ->where(function($query) use ($user_id){
                    $query->whereNull('owner_id')
                    ->orWhere('owner_id','!=',$user_id);
                })
                ->where(function($query) use ($search){
                    $query->where('common_item.name','like',$search)
                    ->orWhere('common_item_type.name','like',$search)
                    ->orWhere('detail','like',$search);
                })->get();
                if(count($useable_common_item)>0){
                    foreach($useable_common_item as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->type</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Ekipman Adı:</u></b> $item->name</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
            else{
                $useable_common_item = CommonItem::select('common_item.id as id','common_item.name as name','common_item_type.name as type','common_item.detail')
                ->leftJoin("common_item_owner","common_item_owner.common_item_id","=","common_item.id")
                ->leftJoin("common_item_type","common_item_type.id","=","common_item.type_id")
                ->where(function($query) use ($user_id){
                    $query->whereNull('owner_id')
                    ->orWhere('owner_id','!=',$user_id);
                })->limit(5)->get();
                if(count($useable_common_item)>0){
                    foreach($useable_common_item as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->type</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Ekipman Adı:</u></b> $item->name</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
        }
        public function get_useable_material(Request $request){
            if(isset($request->search)){
                $search = "%".$request->search."%";
                $useable_material = Material::select('material.id as id','material_type.name as type','material.detail')
                ->leftJoin("material_type","material_type.id","=","material.type_id")
                ->where(function($query) use ($search){
                    $query->where('material_type.name','like',$search)
                    ->orWhere('detail','like',$search);
                })->get();
                if(count($useable_material)>0){
                    foreach($useable_material as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->type</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
            else{
                $useable_material = Material::select('material.id as id','material_type.name as type','material.detail')
                ->leftJoin("material_type","material_type.id","=","material.type_id")
                ->limit(5)->get();
                if(count($useable_material)>0){
                    foreach($useable_material as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->type</b>";
                        $html = "<div class='border border-dark p-3'><span><b><u>Tür:</u></b> $item->type</span></br>
                        <span><b><u>Detay:</u></b> $detail</span></div>";
                        $data[] = array(
                            'id'=> $item->id,
                            'text'=> $text,
                            'html' => $html
                        );
                    }
                    return response()->json($data);
                }
                else{
                    return null;
                }
            }
        }
        public function get_useable_vehicle(Request $request){
            if(isset($request->search)){
                $search = "%".$request->search."%";
                $useable_vehicle = Vehicle::select('vehicle.id as id','vehicle.name as name','vehicle_model.name as model','detail')
                ->leftJoin("vehicle_owner","vehicle_owner.vehicle_id","=","vehicle.id")
                ->leftJoin("vehicle_model","vehicle_model.id","=","vehicle.model_id")
                ->whereNull('owner_id')
                ->where(function($query) use ($search){
                    $query->where('vehicle.name','like',$search)
                    ->orWhere('vehicle_model.name','like',$search)
                    ->orWhere('vehicle.detail','like',$search);
                })->get();
                if(count($useable_vehicle)>0){
                    foreach($useable_vehicle as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->model</b>";
                        $html = "<div class='border border-dark p-3'>
                        <span><b><u>Araç Adı:</u></b> $item->name</span></br>
                        <span><b><u>Marka:</u></b> $item->model</span></br>
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
                $vehicle = Vehicle::select('vehicle.id as id','vehicle.name as name','vehicle_model.name as model','detail')
                ->leftJoin("vehicle_owner","vehicle_owner.vehicle_id","=","vehicle.id")
                ->leftJoin("vehicle_model","vehicle_model.id","=","vehicle.model_id")
                ->whereNull('owner_id')->limit(5)->get();
                if(count($vehicle)>0){
                    foreach($vehicle as $item){
                        $detail = str_split($item->detail,30);
                        $detail = $detail[0];
                        $detail = str_replace('\\n','</br>',$detail);
                        $text = "<b>$item->model-$item->name</b>";
                        $html = "<div class='border border-dark p-3'>
                        <span><b><u>Araç Adı:</u></b> $item->name</span></br>
                        <span><b><u>Marka:</u></b> $item->model</span></br>
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
    //Zimmet Sayfasında Yeni Envanter Oluşturma
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
                if(isset($request->duration)){
                    if($request->duration<1 || $request->duration>10){
                        $data['error'] = "Ömür Hatalı!";
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
                    'duration'=>$request->duration,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
                if($control>0){
                    $item = Hardware::orderByDesc('id')->first();
                    $type = $item->getType->name;
                    $data['id'] = $item->id;
                    $data['text'] ="<b>$type $item->barcode_number</b>";
                    return response()->json($data);
                }
                else{
                    $data['error'] = "Donanım Ekleme Sırasında Hata!";
                    return response()->json($data);
                }
        }
        public function software_create_ajax (Request $request){
            //KONTROL
                if(isset($request->new_type)){
                    $control =   SoftwareType::where('name',$request->new_type)->first();
                    if($control!=NULL){
                        $data['error'] = "Bu Tür Zaten Kullanılıyor!";
                        return response()->json($data);
                    }
                }
                else{
                    $control =   SoftwareType::find($request->type_id);
                    if($control==NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
                if(isset($request->license_time)){
                    if($request->license_time <= 0){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
            //Yazılım Ekleme
            $start_datetime = strtotime($request->start_time);
            $start_time = date('Y-m-d H:i:s',$start_datetime);
            if(isset($request->new_type)){
                SoftwareType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type = SoftwareType::orderByDesc('id')->first();
                $type_id = $type->id;
                $data['type'] = array('id'=>$type->id,'text'=>$type->name);
            }
            else{
                $type_id        =   $request->type_id;
            }
            if(isset($request->license_time)){
                $license_time   =   $request->license_time;
                $finish_time    =   strtotime("+$license_time year",$start_datetime);
                $finish_time = date('Y-m-d H:i:s',$finish_time);
            }
            else{
                $finish_time    =   NULL;
                $license_time   =   NULL;
            }
            $control = Software::insert([
                'name' => $request->name,
                'type_id' => $type_id,
                'license_time' => $license_time,
                'start_time' => $start_time,
                'finish_time' => $finish_time
            ]);
            if($control > 0){
                $item = Software::orderByDesc('id')->first();
                $data['id'] = $item->id;
                $data['text'] ="<b>$item->name</b>";
                return response()->json($data);
            }
            else{
                $data['error'] = "Yazılım Ekleme Sırasında Hata!";
                return response()->json($data);
            }
        }
        public function common_item_create_ajax (Request $request){
            //KONTROL
                if($request->new_type){
                    $type   =   CommonItemType::where('name',$request->new_type)->first();
                    if($type){
                        $data['error'] = "Bu Tür Zaten Kullanılıyor!";
                        return response()->json($data);
                    }
                }
                else{
                    $type   =   CommonItemType::find($request->type_id);
                    if($type==NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
            //Ortak Kullanım Ekleme
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
            if(isset($request->new_type)){
                CommonItemType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type = CommonItemType::orderByDesc('id')->first();
                $type_id = $type->id;
                $data['type'] = array('id'=>$type->id,'text'=>$type->name);
            }
            else{
                $type_id    =   $request->type_id;
            }
            $control = CommonItem::insert([
                'type_id' => $type_id,
                'name' => $request->name,
                'detail' => $detail,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control > 0){
                $item = CommonItem::orderByDesc('id')->first();
                $data['id'] = $item->id;
                $data['text'] ="<b>$item->name</b>";
                return response()->json($data);
            }
            else{
                $data['error'] = "Ortak Kullanım Ekleme Sırasında Hata!";
                return response()->json($data);
            }
        }
        public function material_create_ajax (Request $request){
            //KONTROL
                if($request->new_type){
                    $type   =   MaterialType::where('name',$request->new_type)->first();
                    if($type){
                        $data['error'] = "Bu Tür Zaten Kullanılıyor!";
                        return response()->json($data);
                    }
                }
                else{
                    $type   =   MaterialType::find($request->type_id);
                    if($type==NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
            //Malzeme Ekleme
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
            if(isset($request->new_type)){
                MaterialType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type = MaterialType::orderByDesc('id')->first();
                $type_id = $type->id;
                $data['type'] = array('id'=>$type->id,'text'=>$type->name);
            }
            else{
                $type_id    =   $request->type_id;
            }
            $control = Material::insert([
                'type_id' => $type_id,
                'detail' => $detail,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control > 0){
                $item = Material::orderByDesc('id')->first();
                $item->type = $item->getType->name;
                $data['id'] = $item->id;
                $data['text'] ="<b>$item->type</b>";
                return response()->json($data);
            }
            else{
                $data['error'] = "Malzeme Ekleme Sırasında Hata!";
                return response()->json($data);
            }
        }
        public function vehicle_create_ajax(Request $request)
        {
            //KONTROL
                if($request->new_model){
                    $model = VehicleModel::where('name',$request->new_model)->first();
                    if($model){
                        $data['error'] = "Bu Marka Zaten Mevcut!";
                        return response()->json($data);
                    }
                }
                else{
                    $model = VehicleModel::find($request->model_id);
                    if($model==NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
            //Araç Ekleme
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
                if($request->new_model){
                    VehicleModel::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                    $model = VehicleModel::where('name',$request->new_model)->first();
                    $model_id = $model->id;
                    $data['model'] = array('id'=>$model_id,'text'=>$model->name);
                }
                else{
                    $model_id = $request->model_id;
                }
                $control        =   Vehicle::insert([
                    'name'=>$request->name,
                    'model_id'=>$model_id,
                    'detail'=>$detail,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
                if($control>0){
                    $item = Vehicle::orderByDesc('id')->first();
                    $model = $item->getModel->name;
                    $data['id'] = $item->id;
                    $data['text'] ="<b>$model-$item->name</b>";
                    return response()->json($data);
                }
                else{
                    $data['error'] = "Araç Ekleme Sırasında Hata!";
                    return response()->json($data);
                }
        }
    //Zimmet Fişi
        public function owner_pdf($id){
            $user               =   User::find($id);
            $hardware           =   $user->getHardware;
            $software           =   $user->getSoftware;
            $i=1;
            foreach($hardware as $item){
                $item->id               =   $i;
                $item->type             =   $item->getInfo->getType->name;
                $detail                 =   $item->getInfo->detail;
                $item->serial_number    =   $item->getInfo->serial_number;
                $item->barcode_number   =   $item->getInfo->barcode_number;
                if($item->serial_number == NULL){
                    $item->serial_number = "Belirtilmemiş";
                }
                if($detail != NULL){
                    $detail = str_replace('\\n','  ',$detail);
                    if(strlen($detail) > 40){
                        $detail = str_split($detail,38);
                        $detail = $detail[0]."...";
                    }
                }
                else{
                    $detail = "Yok";
                }
                $item->detail           =   $detail;
                $item->issue_time       =   date_create($item->created_at)->format('d/m/Y');
                $i++;
            }
            $i=1;
            foreach($software as $item){
                $info           =   $item->getInfo;
                $item->type     =   $info->getType->name;
                $item->name     =   $info->name;
                $license_time   =   $info->license_time;
                if($license_time == NULL){
                    $item->license_time = "Süresiz";
                }
                else{
                    $item->license_time = $license_time." Yıl";
                }
                $item->issue_time       =   date_create($item->created_at)->format('d/m/Y');
                $item->id    =   $i;
                $i++;
            }
            return view('front.owner.pdf',compact('user','hardware','software'));
        }
    //Zimmet Tarihi Değiştirme
        public function change_issue_time(Request $request){
            $item_type = $request->item_type;
            $issue_time = date('Y-m-d H:i:s',strtotime($request->issue_time));
            if($item_type == 'hardware'){
                $control = HardwareOwner::where('hardware_id',$request->item_id)->where('owner_id',$request->user_id)->update([
                    'created_at' => $issue_time
                ]);
                if($control >0 ){
                    return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Zimmet Tarihi Değiştirme İşlemi Başarılı!',0.02));
                }
                else{
                    return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Zimmet Tarihi Değiştirme İşlemi Başarısız',0.02));
                }
            }
            else if($item_type == 'software'){
                $control = SoftwareOwner::where('software_id',$request->item_id)->where('owner_id',$request->user_id)->update([
                    'created_at' => $issue_time
                ]);
                if($control >0 ){
                    return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Zimmet Tarihi Değiştirme İşlemi Başarılı!',0.02));
                }
                else{
                    return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Zimmet Tarihi Değiştirme İşlemi Başarısız',0.02));
                }
            }
            else if($item_type == 'common'){
                $control = CommonItemOwner::where('common_item_id',$request->item_id)->where('owner_id',$request->user_id)->update([
                    'created_at' => $issue_time
                ]);
                if($control >0 ){
                    return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Zimmet Tarihi Değiştirme İşlemi Başarılı!',0.02));
                }
                else{
                    return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Zimmet Tarihi Değiştirme İşlemi Başarısız',0.02));
                }
            }
            else if($item_type == 'material'){
                $control = MaterialOwner::where('id',$request->item_id)->where('owner_id',$request->user_id)->update([
                    'created_at' => $issue_time
                ]);
                if($control >0 ){
                    return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Zimmet Tarihi Değiştirme İşlemi Başarılı!',0.02));
                }
                else{
                    return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Zimmet Tarihi Değiştirme İşlemi Başarısız',0.02));
                }
            }
            else{
                $control = VehicleOwner::where('vehicle_id',$request->item_id)->where('owner_id',$request->user_id)->update([
                    'created_at' => $issue_time
                ]);
                if($control >0 ){
                    return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Zimmet Tarihi Değiştirme İşlemi Başarılı!',0.02));
                }
                else{
                    return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Zimmet Tarihi Değiştirme İşlemi Başarısız',0.02));
                }
            }
        }
}
