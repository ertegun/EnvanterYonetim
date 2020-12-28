@extends('front.layouts.master')
@section('title',"Yazılım Yönetim")
@section('software_active',"active")
@section('content')
    @include('front.software.content.main')
@endsection
@section("script")
    <script>
        var software_table_ajax_url = "{{route('software_table_ajax')}}";
        function softwareUpdate(id,name,type_id,license_time,start_time){
            $('#software_update_name').val(name);
            $('#software_update_start_time').val(start_time);
            var license = $('#software_update_license_time');
            if(license_time != 'null'){
                license.prop('disabled',false);
                license.val(license_time);
            }
            else{
                license.prop('disabled',true);
                license.val('');
                license.attr('placeholder','Süresiz');
            }
            $('.software_update_type_select').select2("val",type_id);
            $('#software_update_id').val(id);
        }
        function softwareDelete(id,name,type){
            $('#software_delete_name').text(name);
            $('#software_delete_type').text(type);
            $('#software_delete_id').val(id);
        }
        function softwareCreateShowType(){
            var new_type    =   $('#software_create_new_type');
            var type_select =   $('.software_create_type_select');
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#softwareCreateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
        }
        function softwareCreateNewType(){
            var new_type    =   $('#software_create_new_type');
            var type_select =   $('.software_create_type_select');
            type_select.select2('destroy');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.hide();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
        }
        function softwareCreateDisableLicenseTime(){
            var license_time = $('#software_create_license_time');
            license_time.prop('disabled',true);
            license_time.val('');
            license_time.attr('placeholder','Süresiz Olarak Kaydedilecektir');
        }
        function softwareCreateEnableLicenseTime(){
            var license_time = $('#software_create_license_time');
            license_time.prop('disabled',false);
            license_time.attr('placeholder','');
            license_time.val(1);
        }
        function softwareUpdateShowType(){
            var new_type    =   $('#software_update_new_type');
            var type_select =   $('.software_update_type_select');
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#softwareUpdateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
        }
        function softwareUpdateNewType(){
            var new_type    =   $('#software_update_new_type');
            var type_select =   $('.software_update_type_select');
            type_select.select2('destroy');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.hide();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
        }
        function softwareUpdateDisableLicenseTime(){
            var license_time = $('#software_update_license_time');
            license_time.prop('disabled',true);
            license_time.val('');
            license_time.attr('placeholder','Süresiz Olarak Kaydedilecektir');
        }
        function softwareUpdateEnableLicenseTime(){
            var license_time = $('#software_update_license_time');
            license_time.prop('disabled',false);
            license_time.attr('placeholder','');
            license_time.val(1);
        }
        $(document).ready(function(){
            $('.software_create_type_select').select2({
                dropdownParent: $('#softwareCreateModal')
            });
            $('.software_update_type_select').select2({
                dropdownParent: $('#softwareUpdateModal')
            });
        });
    </script>
    <script src="{{ asset('js/software/main_table.js') }}"></script>
@endsection
