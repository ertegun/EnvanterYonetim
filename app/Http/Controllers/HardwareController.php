<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareModel;
use App\Models\Hardware\HardwareType;

class HardwareController extends Controller
{
    //Donanım CRUD
        public function hardware(){
            return view('front.hardware.main');
        }
        public function hardware_create(Request $request)
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
            if($request->new_type && $request->new_type_prefix){
                HardwareType::insert(['name'=> $request->new_type,'prefix' => $request->new_type_prefix,'created_at' => now(),'updated_at' => now()]);
                if(!isset($request->barcode_number)){
                    $barcode_number = $request->new_type_prefix.'1';
                }
                else{
                    $barcode_number = $request->new_type_prefix.$request->barcode_number;
                }
                $type_id = HardwareType::where('prefix',$request->new_type_prefix)->first()->id;
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
                $model_id = HardwareModel::where('name',$request->new_model)->first()->id;
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
                return redirect()->route('hardware')->withCookie(cookie('success','Ekipman Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withInput()->withCookie(cookie('error','Ekipman Ekleme İşlemi Başarısız!',0.02));
            }
        }
        public function hardware_update(Request $request)
        {
            $serial_number = $request->serial_number;
            if($serial_number == NULL){
                $serial_number = NULL;
            }
            if($request->detail != NULL){
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
            }
            else{
                $detail = '';
            }
            if($request->new_type && $request->new_type_prefix){
                HardwareType::insert(['name'=> $request->new_type,'prefix' => $request->new_type_prefix,'created_at' => now(),'updated_at' => now()]);
                $barcode_number = $request->new_type_prefix.$request->barcode_number;
                $type_id = HardwareType::where('prefix',$request->new_type_prefix)->first()->id;
            }
            else{
                $type_id = $request->type_id;
                $prefix = HardwareType::find($request->type_id)->prefix;
                $barcode_number = $prefix.$request->barcode_number;
            }
            if($request->new_model){
                HardwareModel::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                $model_id = HardwareModel::where('name',$request->new_model)->first()->id;
            }
            else{
                $model_id = $request->model_id;
            }
            if($barcode_number!=$request->old_barcode_number){
                $control    =   Hardware::where('barcode_number',$request->old_barcode_number)
                ->update([
                    'barcode_number'=>$barcode_number,
                    'serial_number'=>$serial_number,
                    'type_id'=>$type_id,
                    'model_id'=>$model_id,
                    'detail'=>$detail,
                    'duration'=>$request->duration,
                    'updated_at'=>now()
                ]);
            }
            else{
                $control    =   Hardware::where('barcode_number',$request->old_barcode_number)
                ->update([
                    'serial_number'=>$serial_number,
                    'type_id'=>$type_id,
                    'model_id'=>$model_id,
                    'detail'=>$detail,
                    'duration'=>$request->duration,
                    'updated_at'=>now()
                ]);
            }
            if($control>0){
                return redirect()->route('hardware')->withCookie(cookie('success','Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Güncelleme Başarısız!',0.02));
            }
        }
        public function hardware_delete(Request $request)
        {
            $control    =   Hardware::where('barcode_number',$request->barcode_number)->delete();
            if($control>0){
                return redirect()->route('hardware')->withCookie(cookie('success','Silme İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Donanım Tipleri CRUD
        public function hardware_type(Request $request){
            $hardware_types = HardwareType::all();
            foreach($hardware_types as $type){
                $type->using_item = $type->getUsingItemsCount();
                $type->total_item = $type->getItemsCount();
                $type->useable_item = $type->getUseableItemsCount();
            }
            return view('front.hardware.type',compact('hardware_types'));
        }
        public function hardware_type_create(Request $request){
            $control = HardwareType::insert([
                'name' => $request->name,
                'prefix' => $request->prefix,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('hardware_type')->withCookie(cookie('success','Tip Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Tip Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function hardware_type_update(Request $request){
            $control    =   HardwareType::where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'prefix'=>$request->prefix,
                'updated_at'=>now()
            ]);
            if($control>0){
                if($request->old_prefix!=$request->prefix){
                    if($request->total_item>0){
                        $items  =   Hardware::select('barcode_number')->where('type_id',$request->id)->get();
                        foreach($items as $item){
                            $new_barcode_number =   $item->barcode_number;
                            $new_barcode_number =   substr($new_barcode_number,(strlen($request->old_prefix)));
                            $new_barcode_number =   $request->prefix.$new_barcode_number;
                            Hardware::where('barcode_number',$item->barcode_number)
                            ->update(['barcode_number'=>$new_barcode_number]);
                        }
                    }
                }
                return redirect()->route('hardware_type')->withCookie(cookie('success','Tip Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Tip Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function hardware_type_delete(Request $request){
            $control = HardwareType::where('id',$request->id)->delete();
            if($control>0){
                return redirect()->route('hardware_type')->withCookie(cookie('success','Tip Silme İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Tip Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Donanım Markaları CRUD
        public function hardware_model(Request $request){
            $hardware_models = HardwareModel::all();
            foreach($hardware_models as $model){
                $model->using_item      =   $model->getUsingItemsCount();
                $model->total_item      =   $model->getItemsCount();
                $model->useable_item    =   $model->getUseableItemsCount();
            }
            return view('front.hardware.model',compact('hardware_models'));
        }
        public function hardware_model_create(Request $request){
            $control = HardwareModel::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('hardware_model')->withCookie(cookie('success','Marka Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function hardware_model_update(Request $request){
            $control = HardwareModel::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('hardware_model')->withCookie(cookie('success','Marka Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function hardware_model_delete(Request $request){
            $control = HardwareModel::where('id',$request->id)->delete();
            if($control > 0){
                return redirect()->route('hardware_model')->withCookie(cookie('success','Marka Silme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Ajax Sorguları
        public function hardware_table_ajax(){
            $hardware = Hardware::all();
            foreach($hardware as $item){
                $item->model    =   $item->getModel->name;
                $item->type     =   $item->getType->name;
                $item->owner    =   ($item->getOwner != NULL)?$item->getOwner->name:NULL;
                $item->prefix   =   $item->getType->prefix;
            }
            $data['hardware'] = $hardware;
            return response()->json($data);
        }
        public function getHardwareElements(Request $request){
            $data['types']  = HardwareType::select('id','name','prefix')->get();
            $data['models'] = HardwareModel::select('id','name')->get();
            return response()->json($data);
        }
}
