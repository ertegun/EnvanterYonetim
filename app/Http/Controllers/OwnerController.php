<?php

namespace App\Http\Controllers;

use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemOwner;
use App\Models\User\User;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareOwner;
use App\Models\Material\Material;
use App\Models\Material\MaterialOwner;
use App\Models\Software\Software;
use App\Models\Software\SoftwareOwner;
use Illuminate\Http\Request;
use App\Models\Transaction\Transaction;
use PDF;

class OwnerController extends Controller
{
    public function owner(Request $request,$id)
    {
        $user = User::find($id);
        return view("front.owner.main",compact('user'));
    }
    public function owner_create(Request $request,$id)
    {
        $user       =   User::find($id);
        $inventory  =   Hardware::select('hardware.bn','hardware.sn','hardware.detail')
        ->leftjoin('owner','owner.bn','hardware.bn')
        ->whereNull('owner.bn')->get();
        return view("front.owner.create",compact('inventory','user'));
    }
    public function owner_create_result(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $item   =   Hardware::where('bn',$request->bn)->first();
        $user   =   User::find($request->id);
        $control = Owner::insert(['bn'=>$request->bn,'id'=>$request->id ,'created_at'=>now(),'updated_at'=>now()]);
        if($control>0){
            Transaction::insert(['admin_name'=>$request->session()->get('name'),'user_name'=>$user->name,'user_email'=>$user->email,'trans_type'=>'Donanım Atama','hard_bn'=>$item->bn,'hard_sn'=>$item->sn,'hard_type'=>$item->getType->name,'hard_detail'=>$item->detail,'created_at'=>now()]);
            return redirect()->route("owner",['id'=>$request->id])->withCookie(cookie('success', 'Donanım Atama Başarılı!',0.02));
        }
        else{
            return redirect()->route('owner',['id'=>$request->id])->withCookie(cookie('error', 'Donanım Atama Başarısız!',0.02));

        }
    }
    public function owner_delete(Request $request,$bn)
    {
        $delete =   Hardware::find($bn);
        $user   =   $delete->getOwner;
        $delete->type=$delete->getType->name;
        return view("front.owner.delete",compact("delete",'user'));
    }
    public function owner_delete_result(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $item   =   Hardware::where('bn',$request->bn)->first();
        $control = Owner::where('bn',$request->bn)->delete();
        $user   =   User::find($request->id);
        if($control>0){
            Transaction::insert(['admin_name'=>$request->session()->get('name'),'user_name'=>$user->name,'user_email'=>$user->email,'trans_type'=>'Donanım İade','hard_bn'=>$item->bn,'hard_sn'=>$item->sn,'hard_type'=>$item->getType->name,'hard_detail'=>$item->detail,'created_at'=>now()]);
            return redirect()->route("owner",['id'=>$request->id])->withCookie(cookie('success', 'Donanım İade İşlemi Başarılı!',0.02));
        }
        else{
            return redirect()->route('owner',['id'=>$request->id])->withCookie(cookie('error', 'Donanım İade İşlemi Başarısız',0.02));

        }
    }
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
            $software = Software::where('id',$request->software_id)->first();
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
            $common = CommonItem::where('id',$request->common_item_id)->first();
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
            $material = Material::where('id',$request->material_id)->first();
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
    //Ajax Sorgusu
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
    public function owner_create_software(Request $request,$id)
    {
        $user       =   User::find($id);
        $software   =   Software::whereNull('owner_id')->get();
        return view("front.owner.create_software",compact('software','user'));
    }
    public function owner_create_software_result(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $control = Software::where('id',$request->soft_id)->update(['owner_id'=>$request->user_id]);
        $user       =   User::find($request->user_id);
        $software   =   Software::find($request->soft_id);
        if($control>0){
            Transaction::insert(['admin_name'=>$request->session()->get('name'),'user_name'=>$user->name,'user_email'=>$user->email,'trans_type'=>'Yazılım Atama','soft_name'=>$software->name,'created_at'=>now()]);
            return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Yazılım Atama Başarılı!',0.02));
        }
        else{
            return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Yazılım Atama Başarısız!',0.02));

        }
    }
    public function owner_delete_software(Request $request,$id)
    {
        $delete =   Software::find($id);
        $user   =   $delete->getOwner;
        return view("front.owner.delete_software",compact("delete",'user'));
    }
    public function owner_delete_software_result(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $control    =   Software::where('id',$request->soft_id)->update(['owner_id'=>NULL]);
        $user       =   User::find($request->user_id);
        $software   =   Software::find($request->soft_id);
        if($control>0){
            Transaction::insert(['admin_name'=>$request->session()->get('name'),'user_name'=>$user->name,'user_email'=>$user->email,'trans_type'=>'Yazılım İade','soft_name'=>$software->name,'created_at'=>now()]);
            return redirect()->route("owner",['id'=>$request->user_id])->withCookie(cookie('success', 'Yazılım İade İşlemi Başarılı!',0.02));
        }
        else{
            return redirect()->route('owner',['id'=>$request->user_id])->withCookie(cookie('error', 'Yazılım İade İşlemi Başarısız',0.02));

        }
    }
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
