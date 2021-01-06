<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material\MaterialType;
use App\Models\Material\Material;

class MaterialController extends Controller
{
    //Malzeme CRUD
        public function material()
        {
            $types = MaterialType::all();
            return view('front.material.main',compact('types'));
        }
        public function material_create(Request $request)
        {
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
                $type_id = MaterialType::where('name',$request->new_type)->first()->id;
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
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Ekipman Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('material')->withCookie(cookie('success','Ekipman Eklendi!',0.02));
            }
        }
        public function material_update(Request $request)
        {
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
                $type_id = MaterialType::where('name',$request->new_type)->first()->id;
            }
            else{
                $type_id    =   $request->type_id;
            }
            $control = Material::where('id',$request->id)
            ->update([
                'type_id' => $type_id,
                'detail' => $detail,
                'updated_at' => now()
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Ekipman Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('material')->withCookie(cookie('success','Ekipman Güncellendi!',0.02));
            }
        }
        public function material_delete(Request $request)
        {
            $control = Material::where('id',$request->id)->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('material')->withCookie(cookie('success','Silme İşlemi Başarılı!',0.02));
            }
        }
    //Malzeme Türleri CRUD
        public function material_type(){
            $material_types = MaterialType::all();
            foreach($material_types as $type){
                $type->using_item   =   $type->getUsingItemsCount();
                $type->total_item   =   $type->getItemsCount();
            }
            return view('front.material.type',compact('material_types'));
        }
        public function material_type_create(Request $request)
        {
            $control = MaterialType::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('material_type')->withCookie(cookie('success','Tür Eklendi!',0.02));
            }
        }
        public function material_type_update(Request $request)
        {
            $control = MaterialType::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('material_type')->withCookie(cookie('success','Tür Güncellendi!',0.02));
            }
        }
        public function material_type_delete(Request $request)
        {
            $control = MaterialType::where('id',$request->id)
            ->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('material_type')->withCookie(cookie('success','Tür Silme İşlemi Başarılı!',0.02));
            }
        }
    //Malzeme Ajax Sorguları
        public function material_table_ajax(Request $request){
            $material = Material::all();
            foreach ($material as $item){
                $item->type     =   $item->getType->name;
            }
            $data['material'] = $material;
            return response()->json($data);
        }
        public function getMaterialElements(Request $request){
            $data['types']  = MaterialType::all();
            return response()->json($data);
        }
}
