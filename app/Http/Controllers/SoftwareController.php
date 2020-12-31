<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Software\Software;
use App\Models\Software\SoftwareType;

class SoftwareController extends Controller
{
    //Yazılım CRUD
        public function software()
        {
            $types = SoftwareType::all();
            return view('front.software.main',compact('types'));
        }
        public function software_create(Request $request)
        {
            $start_datetime = strtotime($request->start_time);
            $start_time = date('Y-m-d H:i:s',$start_datetime);
            if(isset($request->new_type)){
                SoftwareType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type_id = SoftwareType::where('name',$request->new_type)->first()->id;
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
            for($i=0;$i<$request->piece;$i++){
                $control = Software::insert([
                    'name' => $request->name,
                    'type_id' => $type_id,
                    'license_time' => $license_time,
                    'start_time' => $start_time,
                    'finish_time' => $finish_time
                ]);
                if($control <= 0){
                    return redirect()->back()->withCookie(cookie('error','Yazılım Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
                }
            }
            return redirect()->route('software')->withCookie(cookie('success','Yazılım(lar) Eklendi!',0.02));
        }
        public function software_update(Request $request)
        {
            $start_datetime = strtotime($request->start_time);
            $start_time = date('Y-m-d H:i:s',$start_datetime);
            if(isset($request->new_type)){
                SoftwareType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type_id = SoftwareType::where('name',$request->new_type)->first()->id;
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
            $control = Software::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'type_id' => $type_id,
                'license_time' => $license_time,
                'start_time' => $start_time,
                'finish_time' => $finish_time
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('software')->withCookie(cookie('success','Güncelleme Başarılı!',0.02));
            }
        }
        public function software_delete(Request $request)
        {
            $control = Software::where('id',$request->id)->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('software')->withCookie(cookie('success','Silme İşlemi Başarılı!',0.02));
            }
        }
    //Yazılım Türleri CRUD
        public function software_type(){
            $software_types = SoftwareType::all();
            foreach($software_types as $type){
                $type->using_item      =   $type->getUsingItemsCount();
                $type->useable_item    =   $type->getUseableItemsCount();
                $type->total_item      =   $type->getItemsCount();
            }
            return view('front.software.type',compact('software_types'));
        }
        public function software_type_create(Request $request)
        {
            $control = SoftwareType::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('software_type')->withCookie(cookie('success','Tür Eklendi!',0.02));
            }
        }
        public function software_type_update(Request $request)
        {
            $control = SoftwareType::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('software_type')->withCookie(cookie('success','Tür Güncellendi!',0.02));
            }
        }
        public function software_type_delete(Request $request)
        {
            $control = SoftwareType::where('id',$request->id)
            ->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('software_type')->withCookie(cookie('success','Tür Silme İşlemi Başarılı!',0.02));
            }
        }
    //Yazılım Ajax Sorguları
        public function software_table_ajax(Request $request){
            $softwares = Software::all();
            foreach ($softwares as $item){
                $item->type             =   $item->getType->name;
                $item->owner            =   ($item->getOwner !=NULL)? $item->getOwner->name : NULL;
                //Yazılacak Alınış Zamanı
                $start_time_show        =   strtotime($item->start_time);
                $item->update_time      =   date('Y-m-d',$start_time_show);
                $item->start_time_show  =   createTurkishDate($item->start_time);//15 Aralık 2020
                //Yazılacak Bitiş Zamanı
                if($item->finish_time != NULL){
                    $item->finish_time_show =   createTurkishDate($item->finish_time);//15 Aralık 2022
                }
                else{
                    $item->finish_time_show =   NULL;
                }
            }
            $data['software'] = $softwares;
            return response()->json($data);
        }
        public function getSoftwareElements(Request $request){
            $data['types']  = SoftwareType::all();
            return response()->json($data);
        }
}
