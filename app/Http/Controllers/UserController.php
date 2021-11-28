<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use App\Models\User\User;
use App\Models\User\Department;
use App\Models\Software\Software;
use Illuminate\Http\Request;
use App\Models\Transaction\Transaction;

class UserController extends Controller
{
    //KULLANICI
        //Kullanıcı Sayfası Üzerinde
            public function user()
            {
                $departments = Department::all();
                return view("front.user.main",compact('departments'));
            }
            public function user_update(Request $request)
            {
                $email = $request->email . '@gruparge.com';
                if($request->new_department){
                    Department::insert([
                        'name' => $request->new_department,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $department_id = Department::where('name',$request->new_department)->first()->id;
                }
                else{
                    $department_id = $request->department_id;
                }
                $control = User::where('id',$request->id)
                ->update([
                    'name' => $request->name,
                    'email' => $email,
                    'department_id' => $department_id,
                    'updated_at' => now()
                ]);
                if($control>0){
                    return redirect()->route("user")->withCookie(cookie('success', 'Düzenleme Başarılı!',0.02));
                }
                else{
                    return redirect()->back()->withCookie(cookie('error', 'Düzenleme Başarısız',0.02));

                }
            }
            public function user_delete(Request $request)
            {
                $control   =   User::where('id',$request->id)->delete();
                if($control>0){
                    return redirect()->route("user")->withCookie(cookie('success', 'Kullanıcı Silme Başarılı!',0.02));
                }
                else{
                    return redirect()->back()->withCookie(cookie('error', 'Kullanıcı Silme Başarısız',0.02));

                }
            }
        //Ajax Sorgusu
            public function user_table_ajax(Request $request){
                $users= User::all();
                if($request->user()->can('isAdmin') || $request->user()->can('isHR')){
                    $user_crud= true;
                }
                else{
                    $user_crud = false;
                }
                if($request->user()->can('isHR')){
                    $debit= false;
                }
                else{
                    $debit = true;
                }
                foreach($users as $user){
                    $user->user_crud        =   $user_crud;
                    $user->debit            =   $debit;
                    $user->department       =   $user->getDepartment->name;
                    $user->hardware_count   =   $user->getHardwareCount();
                    $user->software_count   =   $user->getSoftwareCount();
                    $user->material_count   =   $user->getMaterialCount();
                    $user->common_count     =   $user->getCommonCount();
                    $user->vehicle_count    =   $user->getVehicleCount();
                    $user->all_equipment    =   $user->hardware_count+$user->software_count
                    +$user->material_count+$user->common_count+$user->vehicle_count;
                }
                $data['users'] = $users;
                return response()->json($data);
            }
            public function getUser(Request $request){
                $user = User::where('id',$request->id)->get()->first();
                $user->getDepartment;
                return response()->json($user);
            }
        //Kullanıcı İşlem Geçmişi
            public function user_transaction(Request $request,$id)
            {
                $user                       =   User::find($id);
                $transactions               =   Transaction::where('user_id',$id)->get();
                foreach($transactions as $transaction){
                    $transaction->type      =   $transaction->getType->name;
                    $transaction->date      =   createTurkishDate($transaction->created_at);
                }
                return view("front.user.transaction",compact('transactions','user'));
            }


    //Kullanıcı Ekleme
        public function user_create_ajax(Request $request)
        {
            //Kontrol
                if(!($request->user()->can('isAdmin') || $request->user()->can('isHR'))){
                    $data['error'] = "Bu İşlem İçin Yetkiniz Yok!";
                    return response()->json($data);
                }
                $email =   $request->email;
                $email.=   "@gruparge.com";
                $control    =   User::where("email",$email)->first();
                if($control != NULL){
                    $data['error'] = "E-Mail Kullanılıyor!";
                    return response()->json($data);
                }
                if($request->new_department){
                    $control = Department::where('name',$request->new_department)->first();
                    if($control != NULL){
                        $data['error'] = "Departman Zaten Mevcut!";
                        return response()->json($data);
                    }
                }
                else{
                    $control =  Department::find($request->department_id);
                    if($control == NULL){
                        $data['error'] = "İşlem Sırasında Hata!";
                        return response()->json($data);
                    }
                }
            //Kullanıcı Ekleme
                if($request->new_department){
                    $control = Department::insert([
                        'name' => $request->new_department,
                        'created_at' => now()
                    ]);
                    $department = Department::orderByDesc('id')->first();
                    $department_id = $department->id;
                }
                else{
                    $department_id = $request->department_id;
                }
                $control = User::insert([
                    'name' => $request->name,
                    'email' => $email,
                    'department_id' => $department_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                if($control >0){
                    $user_id = User::orderByDesc('id')->first()->id;
                    $data['id'] = $user_id;
                    $data['success'] = "Kullanıcı Eklendi!";
                    return response()->json($data);
                }
                else{
                    $data['error'] = "Kullanıcı Ekleme İşlemi Başarısız!";
                    return response()->json($data);
                }
        }
        public function user_create(Request $request){
            $email =   strtolower($request->email);
            $email.=   "@gruparge.com";
            if($request->new_department){
                Department::insert([
                    'name' => $request->new_department,
                    'created_at' => now()
                ]);
                $department = Department::orderByDesc('id')->first();
                $department_id = $department->id;
            }
            else{
                $department_id = $request->department_id;
            }
            $control = User::insert([
                'name' => $request->name,
                'email' => $email,
                'department_id' => $department_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($control>0){
                return redirect()->route("user")->withCookie(cookie('success', 'Kullanıcı Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Kullanıcı Ekleme İşlemi Başarısız!',0.02));

            }
        }
    //DEPARTMAN
        public function department(){
            $departments = Department::all();
            foreach($departments as $item){
                $item->user_count       =   $item->getUserCount();
                $item->hardware_count   =   $item->getHardwareCount();
                $item->software_count   =   $item->getSoftwareCount();
                $item->common_count     =   $item->getCommonCount();
                $item->material_count   =   $item->getMaterialCount();
            }
            return view("front.department.main",compact('departments'));
        }
        public function department_create(Request $request)
        {
            $control = Department::insert([
                'name' => $request->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Departman Ekleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('department')->withCookie(cookie('success','Departman Eklendi!',0.02));
            }
        }
        public function department_update(Request $request)
        {
            $control = Department::where('id',$request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Departman Güncelleme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('department')->withCookie(cookie('success','Departman Güncellendi!',0.02));
            }
        }
        public function department_delete(Request $request)
        {
            $control = Department::where('id',$request->id)
            ->delete();
            if($control <= 0){
                return redirect()->back()->withCookie(cookie('error','Departman Silme İşlemi Sırasında Bir Hata Meydana Geldi!',0.02));
            }
            else{
                return redirect()->route('department')->withCookie(cookie('success','Departman Silme İşlemi Başarılı!',0.02));
            }
        }
    //Departman Ajax
        public function getDepartments(){
            $departments = Department::all();
            $data['departments'] = $departments;
            return response()->json($data);
        }
        public function getDepartment(Request $request){
            $department = Department::where('id',$request->id)->get()->first();
            return response()->json($department);
        }
}
