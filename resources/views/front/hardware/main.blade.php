@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Donanım")
@section('hardware_active',"active")
@section('content')
    @include('front.hardware.content.main')
@endsection
@section("script")
    <script>
        var hardware_table_ajax_url = "{{route('hardware_table_ajax')}}";
        function hardwareDelete(barcode_number,serial_number,detail,type,model){
            $('#hardware_delete_barcode_number_info').text(barcode_number);
            $('#hardware_delete_barcode_number').val(barcode_number);
            $('#hardware_delete_serial_number').text(serial_number);
            $('#hardware_delete_detail').html(detail);
            $('#hardware_delete_type').text(type);
            $('#hardware_delete_model').text(model);
        }
        function hardwareUpdate(barcode_number,serial_number,detail,type_id,model_id,prefix){
            $('#hardware_update_barcode_number').val(barcode_number);
            $('#hardware_update_barcode_number_info').val(barcode_number.slice(prefix.length));
            $('#hardware_update_barcode_number_prepend').text(prefix);
            $('#hardware_update_serial_number').val(serial_number);
            $('#hardware_update_serial_number_info').val(serial_number);
            $('.hardware_update_type_select').select2("val",type_id);
            $('.hardware_update_model_select').select2("val",model_id);
            $('#hardware_update_detail').val(detail);
        }
        function hardwareUpdateNewType(){
            var type_select =   $('.hardware_update_type_select');
            var new_prefix  =   $('#hardware_update_new_type_prefix');
            var new_type    =   $('#hardware_update_new_type');
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.select2('destroy');
            type_select.hide();
            new_prefix.prop('required',true);
            new_prefix.prop('disabled',false);
            new_prefix.show();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
            $('#hardware_update_barcode_number_prepend').text('');
        }
        function hardwareUpdateShowType(){
            var new_prefix  =   $('#hardware_update_new_type_prefix');
            var new_type    =   $('#hardware_update_new_type');
            var type_select =   $('.hardware_update_type_select');
            new_prefix.val('');
            new_prefix.prop('required',false);
            new_prefix.prop('disabled',true);
            new_prefix.hide();
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#hardwareUpdateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
            var prefix = type_select[0].selectedOptions[0].dataset.prefix;
            $('#hardware_update_barcode_number_prepend').text(prefix);
        }
        function hardwareUpdateNewModel(){
            var model_select    =   $('.hardware_update_model_select');
            var new_model       =   $('#hardware_update_new_model')
            model_select.prop('required',false);
            model_select.prop('disabled',true);
            model_select.select2('destroy');
            model_select.hide();
            new_model.prop('required',true);
            new_model.prop('disabled',false);
            new_model.show();
        }
        function hardwareUpdateShowModel(){
            var new_model       =   $('#hardware_update_new_model');
            var model_select    =   $('.hardware_update_model_select')
            new_model.val('');
            new_model.prop('required',false);
            new_model.prop('disabled',true);
            new_model.hide();
            model_select.select2({
                dropdownParent: $('#hardwareUpdateModal')
            });
            model_select.prop('required',true);
            model_select.prop('disabled',false);
            model_select.show();
        }
        function hardwareCreateNewType(){
            var type_select =   $('.hardware_create_type_select');
            var new_prefix  =   $('#hardware_create_new_type_prefix');
            var new_type    =   $('#hardware_create_new_type')
            type_select.prop('required',false);
            type_select.prop('disabled',true);
            type_select.select2('destroy');
            type_select.hide();
            new_prefix.prop('required',true);
            new_prefix.prop('disabled',false);
            new_prefix.show();
            new_type.prop('required',true);
            new_type.prop('disabled',false);
            new_type.show();
            $('#hardware_create_barcode_number_prepend').text('');
        }
        function hardwareCreateShowType(){
            var new_prefix  =   $('#hardware_create_new_type_prefix');
            var new_type    =   $('#hardware_create_new_type');
            var type_select =   $('.hardware_create_type_select');
            new_prefix.val('');
            new_prefix.prop('required',false);
            new_prefix.prop('disabled',true);
            new_prefix.hide();
            new_type.val('');
            new_type.prop('required',false);
            new_type.prop('disabled',true);
            new_type.hide();
            type_select.select2({
                dropdownParent: $('#hardwareCreateModal')
            });
            type_select.prop('required',true);
            type_select.prop('disabled',false);
            type_select.show();
            var prefix = type_select[0].selectedOptions[0].dataset.prefix;
            $('#hardware_create_barcode_number_prepend').text(prefix);
        }
        function hardwareCreateNewModel(){
            var new_model = $('#hardware_create_new_model');
            var model_select = $('.hardware_create_model_select');
            model_select.prop('required',false);
            model_select.prop('disabled',true);
            model_select.select2('destroy');
            model_select.hide();
            new_model.prop('required',true);
            new_model.prop('disabled',false);
            new_model.show();
        }
        function hardwareCreateShowModel(){
            var new_model       =   $('#hardware_create_new_model');
            var model_select    =   $('.hardware_create_model_select');
            new_model.val('');
            new_model.prop('required',false);
            new_model.prop('disabled',true);
            new_model.hide();
            model_select.select2({
                dropdownParent: $('#hardwareCreateModal')
            });
            model_select.prop('required',true);
            model_select.prop('disabled',false);
            model_select.show();
        }
        function hardwareCreateOpenBarcodeNumber(){
            var barcode = $('#hardware_create_barcode_number_info');
            barcode.prop('required',true);
            barcode.prop('disabled',false);
            barcode.val('');
        }
        function hardwareCreateCloseBarcodeNumber(){
            var barcode = $('#hardware_create_barcode_number_info');
            barcode.prop('required',false);
            barcode.prop('disabled',true);
            barcode.val('Otomatik Üretilecektir');
        }
        $('.hardware_update_type_select').on('select2:select', function (e) {
            var prefix = e.params.data.element.dataset.prefix;
            $('#hardware_update_barcode_number_prepend').text(prefix);
        });
        $('#hardware_update_new_type_prefix').on('input',function(e){
            $('#hardware_update_barcode_number_prepend').text($(this).val());
        });
        $('.hardware_create_type_select').on('select2:select', function (e) {
            var prefix = e.params.data.element.dataset.prefix;
            $('#hardware_create_barcode_number_prepend').text(prefix);
        });
        $('#hardware_create_new_type_prefix').on('input',function(e){
            $('#hardware_create_barcode_number_prepend').text($(this).val());
        });
        NgApp.controller('hardwareController',function($http,$scope){
            $http.post("{{route('getHardwareElements')}}").then(function(response){
                $scope.types    =   response.data.types;
                $scope.models   =   response.data.models;
            });
        });
        $(document).ready(function(){
            $('.hardware_update_type_select').select2({
                dropdownParent: $('#hardwareUpdateModal')
            });
            $('.hardware_update_model_select').select2({
                dropdownParent: $('#hardwareUpdateModal')
            });
            $('.hardware_create_type_select').select2({
                dropdownParent: $('#hardwareCreateModal')
            });
            $('.hardware_create_model_select').select2({
                dropdownParent: $('#hardwareCreateModal')
            });
            setTimeout(function(){
                var prefix = $('.hardware_create_type_select option:selected').data('prefix');
                $('#hardware_create_barcode_number_prepend').text(prefix);
            },700);
            setTimeout(function(){
                $('.alert-success').hide();
                $('.alert-error').hide();
            },5000);
        });
    </script>
    <script src="{{asset('js/hardware/main_table.js')}}"></script>
@endsection

