<?php

namespace App\Http\Controllers;

use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemType;
use Illuminate\Http\Request;

class CommonItemController extends Controller
{
    //Ortak Kullanım CRUD
        public function common_item()
        {
            $types = CommonItemType::all();
            return view('front.common_item.main',compact('types'));
        }
        public function common_item_create(Request $request)
        {
            if(isset($request->new_type)){
                CommonItemType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type_id = CommonItemType::where('name',$request->new_type)->first()->id;
            }
            else{
                $type_id    =   $request->type_id;
            }
            $control = CommonItem::insert([
                'type_id' => $type_id,
                'name' => $request->name,
                'detail' => $request->detail,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Ekipman Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('common_item')->withCookie(cookie('success','Ekipman Eklendi!',0.02));
            }
        }
        public function common_item_update(Request $request)
        {
            if(isset($request->new_type)){
                CommonItemType::insert([
                    'name' => $request->new_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $type_id = CommonItemType::where('name',$request->new_type)->first()->id;
            }
            else{
                $type_id    =   $request->type_id;
            }
            $control = CommonItem::where('id',$request->id)
            ->update([
                'type_id' => $type_id,
                'name' => $request->name,
                'detail' => $request->detail,
                'updated_at' => now()
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Ekipman Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('common_item')->withCookie(cookie('success','Ekipman Güncellendi!',0.02));
            }
        }
        public function common_item_delete(Request $request)
        {
            $control = CommonItem::where('id',$request->id)->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('common_item')->withCookie(cookie('success','Silme İşlemi Başarılı!',0.02));
            }
        }
    //Ortak Kullanım Türleri CRUD
        public function common_item_type(){
            $common_item_types = CommonItemType::all();
            foreach($common_item_types as $type){
                $type->using_item  =   count(CommonItem::where('type_id',$type->id)->where('owner_count','>',0)->get());
                $type->total_item      =   $type->getItemsCount();
                $type->useable_item    =   $type->total_item-$type->using_item;
            }
            return view('front.common_item.type',compact('common_item_types'));
        }
        public function common_item_type_create(Request $request)
        {
            $control = CommonItemType::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('common_item_type')->withCookie(cookie('success','Tür Eklendi!',0.02));
            }
        }
        public function common_item_type_update(Request $request)
        {
            $control = CommonItemType::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('common_item_type')->withCookie(cookie('success','Tür Güncellendi!',0.02));
            }
        }
        public function common_item_type_delete(Request $request)
        {
            $control = CommonItemType::where('id',$request->id)
            ->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Tür Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('common_item_type')->withCookie(cookie('success','Tür Silme İşlemi Başarılı!',0.02));
            }
        }
    //Ortak Kullanım Ajax Sorguları
        public function common_item_table_ajax(Request $request){
            $common_item = CommonItem::all();
            foreach ($common_item as $item){
                $item->type             =   $item->getType->name;
                $item->owners           =   $item->getOwners;
            }
            $data['common_item'] = $common_item;
            return response()->json($data);
        }
        public function getCommonItemElements(Request $request){
            $data['types']  = CommonItemType::all();
            return response()->json($data);
        }
        public function getCommonItem(Request $request){
            $common_item = CommonItem::where('id',$request->id)->get()->first();
            $common_item->getType;
            return response()->json($common_item);
        }
        public function getCommonItemType(Request $request){
            $common_item_type = CommonItemType::where('id',$request->id)->get()->first();
            return response()->json($common_item_type);
        }
}
