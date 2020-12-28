@extends('front.layouts.master')
@section('title',"Departman Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.department.content.main')
@endsection
@section("script")
    <script>
        function departmentDelete(id,name){
            $('#department_delete_name').text(name);
            $('#department_delete_id').val(id);
        }
        function departmentUpdate(id,name){
            $('#department_update_name').val(name);
            $('#department_update_old_name').val(name);
            $('#department_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/user/department.js')}}"></script>
@endsection
