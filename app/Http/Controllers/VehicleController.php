<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleModel;

class VehicleController extends Controller
{
    //Araç CRUD
        public function vehicle(){
            return view('front.vehicle.main');
        }
        public function vehicle_create(Request $request)
        {
            if($request->new_model){
                VehicleModel::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                $model_id = VehicleModel::where('name',$request->new_model)->first()->id;
            }
            else{
                $model_id = $request->model_id;
            }
            $control        =   Vehicle::insert([
                'name'=>$request->name,
                'model_id'=>$model_id,
                'detail'=>$request->detail,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
            if($control>0){
                return redirect()->route('vehicle')->withCookie(cookie('success','Araç Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withInput()->withCookie(cookie('error','Araç Ekleme İşlemi Başarısız!',0.02));
            }
        }
        public function vehicle_update(Request $request)
        {
            if($request->new_model){
                VehicleModel::insert(['name' => $request->new_model,'created_at' => now(),'updated_at' => now()]);
                $model_id = VehicleModel::where('name',$request->new_model)->first()->id;
            }
            else{
                $model_id = $request->model_id;
            }
            $control    =   Vehicle::where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'model_id'=>$model_id,
                'detail'=>$request->detail,
                'updated_at'=>now()
            ]);
            if($control>0){
                return redirect()->route('vehicle')->withCookie(cookie('success','Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Güncelleme Başarısız!',0.02));
            }
        }
        public function vehicle_delete(Request $request)
        {
            $control    =   Vehicle::where('id',$request->id)->delete();
            if($control>0){
                return redirect()->route('vehicle')->withCookie(cookie('success','Silme İşlemi Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Araç Markaları CRUD
        public function vehicle_model(Request $request){
            $vehicle_models = VehicleModel::all();
            foreach($vehicle_models as $model){
                $model->using_item      =   $model->getUsingItemsCount();
                $model->total_item      =   $model->getItemsCount();
                $model->useable_item    =   $model->getUseableItemsCount();
            }
            return view('front.vehicle.model',compact('vehicle_models'));
        }
        public function vehicle_model_create(Request $request){
            $control = VehicleModel::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('vehicle_model')->withCookie(cookie('success','Marka Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function vehicle_model_update(Request $request){
            $control = VehicleModel::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now()
            ]);
            if($control > 0){
                return redirect()->route('vehicle_model')->withCookie(cookie('success','Marka Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
        public function vehicle_model_delete(Request $request){
            $control = VehicleModel::where('id',$request->id)->delete();
            if($control > 0){
                return redirect()->route('vehicle_model')->withCookie(cookie('success','Marka Silme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error','Marka Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
        }
    //Ajax Sorguları
        public function vehicle_table_ajax(){
            $vehicle = Vehicle::all();
            foreach($vehicle as $item){
                $item->model    =   $item->getModel->name;
                $item->owner    =   ($item->getOwner != NULL)?$item->getOwner->name:NULL;
            }
            $data['vehicle'] = $vehicle;
            return response()->json($data);
        }
        public function getVehicleElements(Request $request){
            $data['models'] = VehicleModel::select('id','name')->get();
            return response()->json($data);
        }
        public function getVehicle(Request $request){
            $vehicle = Vehicle::where('id',$request->id)->get()->first();
            $vehicle->getModel;
            return response()->json($vehicle);
        }
        public function getVehicleModel(Request $request){
            $vehicle_model = VehicleModel::where('id',$request->id)->get()->first();
            return response()->json($vehicle_model);
        }
}
