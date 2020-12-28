<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\Department;
use App\Models\User\User;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareType;
use App\Models\Hardware\HardwareOwner;
use App\Models\Software\Software;
use App\Models\Software\SoftwareType;
use App\Models\Software\SoftwareOwner;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionType;
use App\Models\Admin\Admin;
use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemOwner;
use App\Models\Material\Material;
use App\Models\Material\MaterialOwner;
class MainController extends Controller
{
    public function homepage()
    {
        return view('front.homepage.main');
    }
    public function login()
    {
        return view('front.login.main');
    }
    public function login_result(Request $request){
        $admin  =   Admin::where('user_name',$request->user_name)->first();
        if($request->remember=="on"){
            session(['name'=>$admin->name,'admin_id' => $admin->id,'rem_name' => $request->user_name,'rem_pass'=>$request->password]);
        }
        else{
            session()->forget(['rem_name','rem_pass']);
            session(['name'=>$admin->name,'admin_id'=>$admin->id]);
        }
        return redirect()->route('homepage');
    }
    public function logout()
    {
        session()->forget(['admin_id']);
        return redirect()->route('login');
    }
    public function transaction()
    {
        return view('front.transaction.main');
    }
    public function transaction_ajax(Request $request){
        $orderColumnId  = $request['order']['0']['column'];
        $orderColumn    =   $request['columns'][$orderColumnId]['data'];
        $data['recordsTotal']  =   Transaction::all()->count();
        $length = $request->length;
        if($length == -1){
            $length = $data['recordsTotal'];
        }
        if($request->search['value']){
            $search     =   "%".$request->search['value']."%";
            $data['data']  =   Transaction::where($request->columns[0]['data'],"like",$search);
            for($i=2;$i<=4;$i++){
                $data['data']=$data['data']->orwhere($request->columns[$i]['data'],"like",$search);
            }
            $data['data']=$data['data']->orWhere('hard_sn',"like",$search);
            $data['data']=$data['data']->orderBy($orderColumn,$request['order']['0']['dir'])->skip($request->start)->take($length)->get();
            $data['recordsFiltered']    =   count($data['data']);
        }
        else{
            $data['data']=Transaction::orderBy($orderColumn,$request['order']['0']['dir'])->skip($request->start)->take($length)->get();
            $data['recordsFiltered']    =   $data['recordsTotal'];
        }
        $data['request'] = $request->all();
        return response()->json($data);
    }
    public function homepage_widgets(Request $request){
        $data['hardware_all']   =   Hardware::all()->count();
        $data['hardware_use']   =   HardwareOwner::all()->count();
        $data['software_all']   =   Software::all()->count();
        $data['software_use']   =   SoftwareOwner::all()->count();
        $data['material_all']   =   Material::all()->count();
        $data['material_use']   =   MaterialOwner::all()->count();
        $data['common_all']     =   CommonItem::all()->count();
        $data['common_use']     =   CommonItemOwner::all()->count();
        $data['department']     =   Department::all()->count();
        $data['user']           =   User::all()->count();
        return response()->json($data);
    }
    public function homepage_currentMonthTransaction(Request $request){
        $data['currentMonth'] = getCurrentMonth(time());
        $start_date = date("Y-m-01 00:00:00");
        $end_date = strtotime("+1 month",strtotime($start_date));
        $end_date = date("Y-m-d 00:00:00",$end_date);
        for($i=1;$i<=4;$i++){
            $j=(2*$i)-1;
            $data['currentMonthTransaction'][] = Transaction::whereBetween('created_at',[$start_date,$end_date])->
            whereBetween('type_id',[$j,$j+1])->count();
        }
        return response()->json($data);
    }
    public function homepage_FiveMonthMaterial(Request $request){
        for($i=4;$i>=0;$i--){
            $start_date = strtotime("-$i month",time());
            $start_date = date("Y-m-01 00:00:00",$start_date);
            $end_date = strtotime("+1 month",strtotime($start_date));
            $end_date = date("Y-m-d 00:00:00",$end_date);
            $data['FiveMonth'][]            =   getCurrentMonth(strtotime("-$i month",time()));
            $data['FiveMonthMaterial'][]    =   Transaction::whereBetween('created_at',[$start_date,$end_date])->
            where('type_id',5)->count();
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
}
