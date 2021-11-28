@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Araç")
@section('vehicle_active',"active")
@section('content')
    @include('front.vehicle.content.main')
@endsection
@section("script")
    <script>
        var vehicle_table_ajax_url = "{{route('vehicle_table_ajax')}}";
        function vehicleDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getVehicle')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#vehicle_delete_detail').html(response.detail);
                    $('#vehicle_delete_model').text(response.get_model.name);
                    $('#vehicle_delete_name').text(response.name);
                    $('#vehicle_delete_id').val(response.id);
                }
            });
        }
        function vehicleUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getVehicle')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#vehicle_update_detail').val(response.detail);
                    //$('.vehicle_update_model_select').select2("val",model_id);
                    $('.vehicle_update_model_select').val(response.model_id).trigger('change');
                    $('#vehicle_update_name').val(response.name);
                    $('#vehicle_update_id').val(response.id);
                }
            });
        }
        function vehicleUpdateNewModel(){
            var model_select    =   $('.vehicle_update_model_select');
            var new_model       =   $('#vehicle_update_new_model')
            model_select.prop('required',false);
            model_select.prop('disabled',true);
            model_select.select2('destroy');
            model_select.hide();
            new_model.prop('required',true);
            new_model.prop('disabled',false);
            new_model.show();
        }
        function vehicleUpdateShowModel(){
            var new_model       =   $('#vehicle_update_new_model');
            var model_select    =   $('.vehicle_update_model_select')
            new_model.val('');
            new_model.prop('required',false);
            new_model.prop('disabled',true);
            new_model.hide();
            model_select.select2({
                dropdownParent: $('#vehicleUpdateModal')
            });
            model_select.prop('required',true);
            model_select.prop('disabled',false);
            model_select.show();
        }
        function vehicleCreateNewModel(){
            var new_model = $('#vehicle_create_new_model');
            var model_select = $('.vehicle_create_model_select');
            model_select.prop('required',false);
            model_select.prop('disabled',true);
            model_select.select2('destroy');
            model_select.hide();
            new_model.prop('required',true);
            new_model.prop('disabled',false);
            new_model.show();
        }
        function vehicleCreateShowModel(){
            var new_model       =   $('#vehicle_create_new_model');
            var model_select    =   $('.vehicle_create_model_select');
            new_model.val('');
            new_model.prop('required',false);
            new_model.prop('disabled',true);
            new_model.hide();
            model_select.select2({
                dropdownParent: $('#vehicleCreateModal')
            });
            model_select.prop('required',true);
            model_select.prop('disabled',false);
            model_select.show();
        }
        NgApp.controller('vehicleController',function($http,$scope){
            $http.post("{{route('getVehicleElements')}}").then(function(response){
                $scope.models   =   response.data.models;
            });
        });
        $(document).ready(function(){
            $('.vehicle_update_model_select').select2({
                dropdownParent: $('#vehicleUpdateModal')
            });
            $('.vehicle_create_model_select').select2({
                dropdownParent: $('#vehicleCreateModal')
            });
            setTimeout(function(){
                $('.alert-success').hide();
                $('.alert-error').hide();
            },5000);
        });
    </script>
    <script src="{{asset('js/vehicle/main_table.js')}}"></script>
@endsection

