@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Ortak Kullanım Türleri")
@section('common_item_active',"active")
@section('content')
    @include('front.common_item.content.type')
@endsection
@section("script")
    <script>
        function commonItemTypeDelete(id,name){
            $('#common_item_type_delete_name').text(name);
            $('#common_item_type_delete_id').val(id);
        }
        function commonItemTypeUpdate(id,name){
            $('#common_item_type_update_name').val(name);
            $('#common_item_type_update_old_name').val(name);
            $('#common_item_type_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/common_item/type_table.js')}}"></script>
@endsection

