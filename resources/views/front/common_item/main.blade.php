@extends('front.layouts.master')
@section('title',"Ortak Kullanım Yönetim")
@section('common_item_active',"active")
@section('content')
    @include('front.common_item.content.main')
@endsection
@section("script")
    <script>
        var common_item_table_ajax_url = "{{route('common_item_table_ajax')}}";
        function commonItemUpdate(id,type_id,name,detail){
            $('#common_item_update_name').val(name);
            $('#common_item_update_detail').val(detail);
            $('.common_item_update_type_select').select2("val",type_id);
            $('#common_item_update_id').val(id);
        }
        function commonItemDelete(id,type,name,detail){
            $('#common_item_delete_name').text(name);
            $('#common_item_delete_detail').text(detail);
            $('#common_item_delete_type').text(type);
            $('#common_item_delete_id').val(id);
        }
        function commonItemCreateShowType(){
            var new_type    =   $('#common_item_create_new_type');
            var type_select =   $('.common_item_create_type_select');
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#commonItemCreateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
        }
        function commonItemCreateNewType(){
            var new_type    =   $('#common_item_create_new_type');
            var type_select =   $('.common_item_create_type_select');
            type_select.select2('destroy');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.hide();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
        }
        function commonItemUpdateShowType(){
            var new_type    =   $('#common_item_update_new_type');
            var type_select =   $('.common_item_update_type_select');
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#commonItemUpdateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
        }
        function commonItemUpdateNewType(){
            var new_type    =   $('#common_item_update_new_type');
            var type_select =   $('.common_item_update_type_select');
            type_select.select2('destroy');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.hide();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
        }
        $(document).ready(function(){
            $('.common_item_create_type_select').select2({
                dropdownParent: $('#commonItemCreateModal')
            });
            $('.common_item_update_type_select').select2({
                dropdownParent: $('#commonItemUpdateModal')
            });
        });
    </script>
    <script src="{{ asset('js/common_item/main_table.js') }}"></script>
@endsection
