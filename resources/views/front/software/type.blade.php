@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Yazılım Tipleri")
@section('software_active',"active")
@section('content')
    @include('front.software.content.type')
@endsection
@section("script")
    <script>
        function softwareTypeDelete(id,name){
            $('#software_type_delete_name').text(name);
            $('#software_type_delete_id').val(id);
        }
        function softwareTypeUpdate(id,name){
            $('#software_type_update_name').val(name);
            $('#software_type_update_old_name').val(name);
            $('#software_type_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/software/type_table.js')}}"></script>
@endsection

