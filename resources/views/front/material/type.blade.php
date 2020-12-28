@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Malzeme Türleri")
@section('material_active',"active")
@section('content')
    @include('front.material.content.type')
@endsection
@section("script")
    <script>
        function materialTypeDelete(id,name){
            $('#material_type_delete_name').text(name);
            $('#material_type_delete_id').val(id);
        }
        function materialTypeUpdate(id,name){
            $('#material_type_update_name').val(name);
            $('#material_type_update_old_name').val(name);
            $('#material_type_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/material/type_table.js')}}"></script>
@endsection

