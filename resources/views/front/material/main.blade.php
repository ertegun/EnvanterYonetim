@extends('front.layouts.master')
@section('title',"Malzeme Yönetim")
@section('material_active',"active")
@section('content')
    @include('front.material.content.main')
@endsection
@section("script")
    <script>
        var material_table_ajax_url = "{{route('material_table_ajax')}}";
        function materialUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getMaterial')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#material_update_detail').val(response.detail);
                    //$('.material_update_type_select').select2("val",type_id);
                    $('.material_update_type_select').val(response.type_id).trigger('change');
                    $('#material_update_id').val(response.id);
                }
            });
        }
        function materialDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getMaterial')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#material_delete_detail').html(response.detail);
                    $('#material_delete_type').text(response.get_type.name);
                    $('#material_delete_id').val(response.id);
                }
            });
        }
        function materialCreateShowType(){
            var new_type    =   $('#material_create_new_type');
            var type_select =   $('.material_create_type_select');
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#materialCreateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
        }
        function materialCreateNewType(){
            var new_type    =   $('#material_create_new_type');
            var type_select =   $('.material_create_type_select');
            type_select.select2('destroy');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.hide();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
        }
        function materialUpdateShowType(){
            var new_type    =   $('#material_update_new_type');
            var type_select =   $('.material_update_type_select');
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#materialUpdateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
        }
        function materialUpdateNewType(){
            var new_type    =   $('#material_update_new_type');
            var type_select =   $('.material_update_type_select');
            type_select.select2('destroy');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.hide();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
        }
        $(document).ready(function(){
            $('.material_create_type_select').select2({
                dropdownParent: $('#materialCreateModal')
            });
            $('.material_update_type_select').select2({
                dropdownParent: $('#materialUpdateModal')
            });
        });
    </script>
    <script src="{{ asset('js/material/main_table.js') }}"></script>
@endsection
