@extends('front.layouts.master')
@section('title',"Departman Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.department.content.main')
@endsection
@section("script")
    <script>
        function departmentDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getDepartment')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#department_delete_name').text(response.name);
                    $('#department_delete_id').val(response.id);
                }
            });
        }
        function departmentUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getDepartment')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#department_update_name').val(response.name);
                    $('#department_update_old_name').val(response.name);
                    $('#department_update_id').val(response.id);
                }
            });
        }
    </script>
    <script src="{{asset('js/user/department.js')}}"></script>
@endsection
