@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Araç Markaları")
@section('vehicle_active',"active")
@section('content')
    @include('front.vehicle.content.model')
@endsection
@section("script")
    <script>
        function vehicleModelDelete(id,name){
            $('#vehicle_model_delete_name').text(name);
            $('#vehicle_model_delete_id').val(id);
        }
        function vehicleModelUpdate(id,name){
            $('#vehicle_model_update_name').val(name);
            $('#vehicle_model_update_old_name').val(name);
            $('#vehicle_model_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/vehicle/model_table.js')}}"></script>
@endsection

