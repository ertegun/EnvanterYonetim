<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Hardware\Hardware;
use App\Models\Software\Software;
use App\Models\Transaction\Transaction;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use App\Models\CommonItem\CommonItem;
use App\Models\Material\Material;
use App\Models\Material\MaterialOwner;
use App\Models\Reset;
use App\Models\Vehicle\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    //Ana Sayfa
        public function homepage()
        {
            return view('front.homepage.main');
        }
    //Giriş Çıkış
        public function login(Request $request)
        {
            return view('front.login.main');
        }
        public function login_result(Request $request){
            if(Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])){
                $user = Auth::user();
                Auth::login($user,true);
                if(isset($request->remember) && $request->remember == 'on'){
                    session([
                        'user_name' => $user->user_name
                    ]);
                }
                else{
                    session()->forget(['user_name']);
                }
                return redirect()->route('homepage');
            }
            else{
                return redirect()->back()->withInput()->withErrors('Kullanıcı Adı Veya Şifre Hatalı!');
            }
        }
        public function logout()
        {
            Auth::logout();
            return redirect()->route('login');
        }
    //Şifremi Unuttum
        public function forget_password(Request $request){
            $email =   $request->email;
            $email.=   "@gruparge.com";
            $admin = Admin::where('email',$email)->first();
            Reset::insert([
                'admin_id' => $admin->id,
                'token' => $request->token,
                'created_at' => now()
            ]);
            $data = [
                'admin_name' => $admin->name,
                'admin_user_name' => $admin->user_name,
                'token'      => $request->token
            ];
            Mail::to($email)->send(new ResetPasswordMail($data));
            return redirect()->route("login")->withCookie(cookie('success', 'Şifre Sıfırlama Maili Gönderildi!',0.02));
        }
        public function reset_password($token){
            return view('front.login.reset',compact('token'));
        }
        public function reset_password_confirm(Request $request){
            if($request->password != $request->password_repeat){
                return redirect()->back()->withCookie(cookie('error', 'Şifre Sıfırlama Sırasında Hata!',0.02));
            }
            else{
                $reset_request  =   Reset::where('token',$request->token)->first();
                $control        =   Admin::where('id',$reset_request->admin_id)->update([
                    'password' => Hash::make($request->password)
                ]);
                if($control>0){
                    Reset::where('token',$request->token)->delete();
                    return redirect()->route("login")->withCookie(cookie('success', 'Şifre Sıfırlama Başarılı!',0.02));
                }
                else{
                    return redirect()->back()->withCookie(cookie('error', 'Şifre Sıfırlama Sırasında Hata!',0.02));

                }
            }
        }
    //İşlem Geçmişi
        public function transaction(){
            return view('front.transaction.main');
        }
        public function transaction_ajax(Request $request){
            $orderColumnId  =   $request['order']['0']['column'];
            $orderColumn    =   $request['columns'][$orderColumnId]['name'];
            $data['recordsTotal']  =   Transaction::all()->count();
            $length = $request->length;
            if($length == -1){
                $length = $data['recordsTotal'];
            }
            if($request->search['value']){
                $search     =   "%".$request->search['value']."%";
                $transaction  =   Transaction::select('transaction_type.name as type','transaction.type_id','transaction.created_at as created_at','transaction.user_name','transaction.admin_name','transaction.trans_info','transaction.trans_details')
                ->leftJoin('transaction_type','transaction.type_id','=','transaction_type.id')
                ->where($request->columns[0]['name'],"like",$search);
                for($i=2;$i<=4;$i++){
                    $transaction=$transaction->orwhere($request->columns[$i]['name'],"like",$search);
                }
                $transaction=$transaction->orderBy($orderColumn,$request['order']['0']['dir'])->skip($request->start)->take($length)->get();
                foreach($transaction as $item){
                    $item->issue_time = createTurkishDate($item->created_at);
                }
                $data['data'] = $transaction;
                $data['recordsFiltered']    =   count($data['data']);
            }
            else{
                $transaction=Transaction::select('transaction_type.name as type','transaction.type_id','transaction.created_at as created_at','transaction.user_name','transaction.admin_name','transaction.trans_info','transaction.trans_details')
                ->leftJoin('transaction_type','transaction.type_id','=','transaction_type.id')
                ->orderBy($orderColumn,$request['order']['0']['dir'])->skip($request->start)->take($length)->get();
                foreach($transaction as $item){
                    $item->issue_time = createTurkishDate($item->created_at);
                }
                $data['data'] = $transaction;
                $data['recordsFiltered']    =   $data['recordsTotal'];
            }
            $data['request'] = $request->all();
            return response()->json($data);
        }
    //Ana Sayfa Widgetlar
        public function homepage_widgets(Request $request){
            $data['hardware_all']   =   Hardware::all()->count();
            $data['software_all']   =   Software::all()->count();
            $data['material_all']   =   Material::all()->count();
            $data['common_all']     =   CommonItem::all()->count();
            $data['vehicle_all']    =   Vehicle::all()->count();
            $data['user']           =   User::all()->count();
            return response()->json($data);
        }
        public function homepage_currentMonthTransaction(Request $request){
            $data['currentMonth'] = getCurrentMonth(time());
            $start_date = date("Y-m-01 00:00:00");
            $end_date = strtotime("+1 month",strtotime($start_date));
            $end_date = date("Y-m-d 00:00:00",$end_date);
            for($i=1;$i<=5;$i++){
                $j=(2*$i)-1;
                $data['currentMonthTransaction'][] = Transaction::whereBetween('created_at',[$start_date,$end_date])->
                whereBetween('type_id',[$j,$j+1])->count();
            }
            return response()->json($data);
        }
        public function homepage_FiveMonthMaterial(Request $request){
            for($i=4;$i>=0;$i--){
                $start_date = strtotime("-$i months",time());
                $start_date = date("Y-m-01 00:00:00",$start_date);
                $end_date = strtotime("+1 months",strtotime($start_date));
                $end_date = date("Y-m-d 00:00:00",$end_date);
                $data['date'][] = array('start'=> $start_date,'end'=>$end_date);
                $data['FiveMonth'][]            =   getCurrentMonth(strtotime("-$i months",time()));
                $data['FiveMonthMaterial'][]    =   MaterialOwner::whereBetween('created_at',[$start_date,$end_date])->count();
            }
            return response()->json($data);
        }
        public function homepage_lastFiveUser(Request $request){
            $lastFiveUser = User::select('name', 'department_id')->orderByRaw('created_at DESC')->limit(5)->get();
            foreach ($lastFiveUser as $user){
                $department = $user->getDepartment;
                $user->department = $department->name;
            }
            return response()->json($lastFiveUser);
        }
        public function homepage_lastFiveTransaction(Request $request){
            $lastFiveTransaction = Transaction::orderByRaw('created_at DESC')->limit(5)->get();
            foreach ($lastFiveTransaction as $trans){
                $trans->type = $trans->getType->name;
            }
            return response()->json($lastFiveTransaction);
        }
    //Yönetim CRUD
        public function admin(Request $request){
            $admins     =   Admin::all();
            return view('front.admin.main',compact('admins'));
        }
        public function admin_create(Request $request){
            $email  =   strtolower($request->email);
            $email .= '@gruparge.com';
            $admin = new Admin;
            $admin->name        =  $request->name;
            $admin->user_name   =  $request->user_name;
            $admin->email       =  $email;
            $admin->password    =  bcrypt($request->password);
            $admin->role_id     =  $request->role_id;
            if($admin->save()){
                return redirect()->route("admin")->withCookie(cookie('success', 'Yetkili Eklendi!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Yetkili Ekleme İşlemi Başarısız!',0.02));

            }
        }
        public function admin_update(Request $request){
            $email  =   strtolower($request->email);
            $email .= '@gruparge.com';
            $control = Admin::where('id',$request->admin_id)->update([
                'user_name' => $request->user_name,
                'name'  => $request->name,
                'email' => $email,
                'role_id' => $request->role_id
            ]);
            if($control>0){
                return redirect()->route("admin")->withCookie(cookie('success', 'Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Güncelleme Başarısız',0.02));

            }
        }
        public function admin_update_password(Request $request){
            $control = Admin::where('id',$request->admin_id)->update([
                'password' => Hash::make($request->password)
            ]);
            if($control>0){
                return redirect()->route("admin")->withCookie(cookie('success', 'Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Güncelleme Başarısız',0.02));

            }
        }
        public function admin_delete(Request $request){
            $control = Admin::where('id',$request->admin_id)->delete();
            if($control>0){
                return redirect()->route("admin")->withCookie(cookie('success', 'Yetkili Silme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Yetkili Silme Başarısız',0.02));

            }
        }
    //Yetkili CRUD
        public function competent(Request $request){
            return view('front.competent.main');
        }
        public function competent_update(Request $request){
            $email  =   strtolower($request->email);
            $email .= '@gruparge.com';
            $control = Admin::where('id',$request->user()->id)->update([
                'user_name' => $request->user_name,
                'name'  => $request->name,
                'email' => $email
            ]);
            if($control>0){
                return redirect()->route("competent")->withCookie(cookie('success', 'Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Güncelleme Başarısız',0.02));

            }
        }
        public function competent_update_password(Request $request){
            $control = Admin::where('id',$request->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            if($control>0){
                return redirect()->route("competent")->withCookie(cookie('success', 'Şifre Güncelleme Başarılı!',0.02));
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Şifre Güncelleme Başarısız',0.02));

            }
        }
        public function competent_delete(Request $request){
            $id = $request->user()->id;
            Auth::logout();
            $control = Admin::where('id',$id)->delete();
            if($control>0){
                return redirect()->route("login");
            }
            else{
                return redirect()->back()->withCookie(cookie('error', 'Hesap Silme Sırasında Hata!',0.02));

            }
        }
    //Rol Tablosu Ajax
        public function getRoles(){
            $roles = Role::all();
            $data['roles'] = $roles;
            return response()->json($data);
        }
}
