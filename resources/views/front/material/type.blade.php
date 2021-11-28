@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Malzeme Türleri")
@section('material_active',"active")
@section('content')
    @include('front.material.content.type')
@endsection
@section("script")
    <script>
        function materialTypeDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getMaterialType')}}`,
                data:{id},
                success:function(response){
                    $('#material_type_delete_name').text(response.name);
                    $('#material_type_delete_id').val(response.id);
                }
            });
        }
        function materialTypeUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getMaterialType')}}`,
                data:{id},
                success:function(response){
                    $('#material_type_update_name').val(response.name);
                    $('#material_type_update_old_name').val(response.name);
                    $('#material_type_update_id').val(response.id);
                }
            });
        }
    </script>
    <script src="{{asset('js/material/type_table.js')}}"></script>
@endsection

