<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Owner;
use Illuminate\Support\Facades\Redis;

class TypeController extends Controller
{
    public function type()
    {
        $types  =   Type::all();
        foreach($types as $type){
            $type->total_items  =   $type->getItemsCount();
            $type->use_items    =   $type->getUsingItemsCount();
        }
        return view('front.type.main',compact('types'));
    }
    public function type_create()
    {
        return view('front.type.create');
    }
    public function type_create_result(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $control    =   Type::insert(['prefix'=>$request->type_prefix,'name'=>$request->type_name,'created_at'=>now(),'updated_at'=>now(),'current'=>1]);
        if($control>0){
            return redirect()->route('type')->withCookie(cookie('success','Tip Ekleme Başarılı!',0.02));
        }
        else{
            return redirect()->back()->withInput()->withCookie(cookie('error','Tip Ekleme İşlemi Başarısız!',0.02));
        }
    }
    public function type_update($id)
    {
        $select             =   Type::find($id);
        $select->total_item =   $select->getItemsCount();
        return view('front.type.update',compact('select'));
    }
    public function type_update_result(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $control        =   Type::where('id',$request->type_id)
        ->update(['name'=>$request->type_name,'prefix'=>$request->type_prefix,'updated_at'=>now()]);
        if($control>0){
            if($request->old_type_prefix!=$request->type_prefix){
                if($request->total_item>0){
                    $items  =   Hardware::select('bn')->where('type_id',$request->type_id)->get();
                    foreach($items as $item){
                        $new_bn =   $item->bn;
                        $new_bn =   substr($new_bn,(strlen($request->old_type_prefix)));
                        $new_bn =   $request->type_prefix.$new_bn;
                        Hardware::where('bn',$item->bn)->update(['bn'=>$new_bn]);
                    }
                }
            }
            return redirect()->route('type')->withCookie(cookie('success','Tip Güncelleme Başarılı!',0.02));
        }
    }
    public function type_delete($id)
    {
        $type   =   Type::find($id);
        return view('front.type.delete',compact('type'));
    }
    public function type_delete_result(Request $request)
    {
        $control    =   Type::where('id',$request->type_id)->delete();
        if($control>0){
            return redirect()->route('type')->withCookie(cookie('success','Silme İşlemi Başarılı!',0.02));
        }
        else{
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Meydana Geldi!',0.02));
        }
    }
}
