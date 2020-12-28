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
                foreach($users as $user){
                    $user->department       =   $user->getDepartment->name;
                    $user->hardware_count   =   $user->getHardwareCount();
                    $user->software_count   =   $user->getSoftwareCount();
                    $user->material_count   =   $user->getMaterialCount();
                    $user->common_count     =   $user->getCommonCount();
                    $user->all_equipment    =   $user->hardware_count+$user->software_count+$user->material_count+$user->common_count;
                }
                $data['users'] = $users;
                return response()->json($data);
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
        public function user_create(Request $request)
        {
            $departments                =   Department::all();
            return view("front.user.create",compact('departments'));
        }
        public function user_create_result(Request $request)
        {
            date_default_timezone_set('Europe/Istanbul');
            $email =   $request->email;
            $email.=   "@gruparge.com";
            $control = User::insert(['name'=>$request->name,'email'=>$email ,'dep_id'=>$request->dep_id,'created_at'=>now(),'updated_at'=>now()]);
            if($control>0){
                return redirect()->route("user")->withCookie(cookie('success', 'Kayıt Başarılı!',0.02));
            }
            else{
                return redirect()->route('user_create')->withCookie(cookie('error', 'Kayıt İşlemi Başarısız!',0.02));

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
}
