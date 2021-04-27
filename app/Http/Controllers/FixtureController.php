<?php

namespace App\Http\Controllers;

use App\Models\Fixture\Fixture;
use App\Models\Fixture\FixtureBrand;
use App\Models\Fixture\FixtureType;
use App\Models\Properties\Supplier;
use App\Models\Properties\Status;
use App\Models\Properties\Bill;
use App\Models\Properties\Exchange;
use App\Models\User\Department;
use App\Models\User\Section;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    //Demirbaş CRUD
        public function fixture(){
            return view('front.fixture.main.master');
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
                FixtureType::insert(['name'=> $request->new_type,'prefix' => $request->new_type_prefix,'created_at' => now(),'updated_at' => now()]);
                if(!isset($request->barcode_number)){
                    $barcode_number = $request->new_type_prefix.'1';
                }
                else{
                    $barcode_number = $request->new_type_prefix.$request->barcode_number;
                }
                $type_id = FixtureType::where('prefix',$request->new_type_prefix)->first()->id;
            }
            else{
                $type_id = $request->type_id;
                $prefix = FixtureType::find($request->type_id)->prefix;
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
                FixtureBrand::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                $model_id = FixtureBrand::where('name',$request->new_model)->first()->id;
            }
            else{
                $model_id = $request->model_id;
            }
            $control        =   Fixture::insert([
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
                FixtureType::insert(['name'=> $request->new_type,'prefix' => $request->new_type_prefix,'created_at' => now(),'updated_at' => now()]);
                $barcode_number = $request->new_type_prefix.$request->barcode_number;
                $type_id = FixtureType::where('prefix',$request->new_type_prefix)->first()->id;
            }
            else{
                $type_id = $request->type_id;
                $prefix = FixtureType::find($request->type_id)->prefix;
                $barcode_number = $prefix.$request->barcode_number;
            }
            if($request->new_model){
                FixtureBrand::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                $model_id = FixtureBrand::where('name',$request->new_model)->first()->id;
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
    //Demirbaş Tipleri CRUD
        public function hardware_type(Request $request){
            $hardware_types = FixtureType::all();
            foreach($hardware_types as $type){
                $type->using_item = $type->getUsingItemsCount();
                $type->total_item = $type->getItemsCount();
                $type->useable_item = $type->getUseableItemsCount();
            }
            return view('front.hardware.type',compact('hardware_types'));
        }
        public function hardware_type_create(Request $request){
            $control = FixtureType::insert([
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
            $control    =   FixtureType::where('id',$request->id)
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
            $control = FixtureType::where('id',$request->id)->delete();
            if($control>0){
                return redirect()->route('hardware_type')->withCookie(cookie('success','Tip Silme İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Tip Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Demirbaş Markaları CRUD
        public function fixture_brand(Request $request){
            $fixture_brands = FixtureBrand::all();
            return view('front.fixture.brand',compact('fixture_brands'));
        }
        public function fixture_brand_create(Request $request){
            $control = FixtureBrand::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('fixture_brand')->withCookie(cookie('success','Marka Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function fixture_brand_update(Request $request){
            $control = FixtureBrand::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('fixture_brand')->withCookie(cookie('success','Marka Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function fixture_brand_delete(Request $request){
            $control = FixtureBrand::where('id',$request->id)->delete();
            if($control > 0){
                return redirect()->route('fixture_brand')->withCookie(cookie('success','Marka Silme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Ajax Sorguları
        public function fixture_table_ajax(){
            $fixture = Fixture::all();
            foreach($fixture as $item){
                $item->getDepartment;
                $item->getSection;
                $item->getType;
                $item->getBrand;
                $item->getBill;
                $item->getSupplier;
            }
            $data['fixture'] = $fixture;
            return response()->json($data);
        }
        public function getFixtureElements(Request $request){
            $data['departments']    =   Department::all();
            $data['types']          =   FixtureType::all();
            $data['brands']         =   FixtureBrand::all();
            $data['suppliers']      =   Supplier::all();
            $data['statuses']       =   Status::all();
            $data['exchanges']      =   Exchange::all();
            $data['bills']          =   Bill::all();
            return response()->json($data);
        }
        public function getSections(Request $request){
            $sections   =   Section::where('department_id',$request->dep_id)->get();
            $data       =   array();
            foreach($sections as $section){
                $data[]   = array(
                    'id'    =>  $section->id,
                    'text'  =>  $section->name,
                    'prefix' => $section->prefix
                );
            }
            return response()->json($data);
        }
        public function checkBarcode(Request $request){
            $control = Fixture::where('department_id',$request->department_id)
            ->where('section_id',$request->section_id)
            ->where('brand_id',$request->brand_id)
            ->where('barcode_number',$request->barcode_number)->first();
            if($request->update){
                if($control){
                    if($control->id == $request->current_id){
                        $data = false;
                    }
                    else{
                        $data = true;
                    }
                }
                else{
                    $data = false;
                }
            }
            else{
                if(count($control) > 0){
                    $data = true;
                }
                else{
                    $data = false;
                }
            }
            return response()->json($data);
        }
}
