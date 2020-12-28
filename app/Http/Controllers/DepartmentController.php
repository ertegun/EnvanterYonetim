<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Owner;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function department()
    {
        $departments =   Department::all();
        foreach($departments as $department){
            $department->user_count =   $department->getUsersCount();
            $department->item_count =   $department->getItemsCount();
            $department->soft_count =   $department->getSoftwaresCount();
        }
        return view('front.department.main',compact('departments'));
    }
    public function department_create()
    {
        return view('front.department.create');
    }
    public function department_create_result(Request $request)
    {
        $control    =   Department::insert(['name'=>$request->name]);
        if($control>0){
            return redirect()->route('department')->withCookie(cookie('success','Birim Kaydı Başarılı!',0.02));
        }
        else{
            return redirect()->back()->withInput()->withCookie(cookie('error','Birim Kaydı Başarısız!',0.02));
        }
    }
    public function department_update($id)
    {
        $department =  Department::find($id);
        return view('front.department.update',compact('department'));
    }
    public function department_update_result(Request $request)
    {
        $control    =   Department::where('id',$request->id)
        ->update(['name'=>$request->name]);
        if($control>0){
            return redirect()->route('department')->withCookie('success','Birim Güncelleme Başarılı!',0.02);
        }
        else{
            return redirect()->back()->withCookie('error','Birim Güncelleme Başarısız!',0.02);
        }
    }
    public function department_delete($id)
    {
        $department =   Department::find($id);
        return view('front.department.delete',compact('department'));
    }
    public function department_delete_result(Request $request)
    {
        $control    =   Department::where('id',$request->id)
        ->delete();
        if($control>0){
            return redirect()->route('department')->withCookie(cookie('success','Birim Başarıyla Silindi!',0.02));
        }
        else{
            return redirect()->back()->withCookie(cookie('error','Birim Silme Başarısız!',0.02));
        }
    }
    public function getDepartments(Request $request){
        //Örnek Select 2 Ajax
        /*$search = "%".$request->search."%";
        $departments = Department::select('id','name')->where('name','like',$search)->get();
        if(count($departments)>0){
            foreach($departments as $item){
                $id = $item->id;
                $name = $item->name;
                $data[] = array('id'=>$id,'text'=>$name);
            }
        }*/
        $departments = Department::all();
        return response()->json($departments);
    }
}
