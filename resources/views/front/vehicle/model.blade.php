@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Araç Markaları")
@section('vehicle_active',"active")
@section('content')
    @include('front.vehicle.content.model')
@endsection
@section("script")
    <script>
        function vehicleModelDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getVehicleModel')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#vehicle_model_delete_name').text(response.name);
                    $('#vehicle_model_delete_id').val(response.id);
                }
            });
        }
        function vehicleModelUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getVehicleModel')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#vehicle_model_update_name').val(response.name);
                    $('#vehicle_model_update_old_name').val(response.name);
                    $('#vehicle_model_update_id').val(response.id);
                }
            });
        }
    </script>
    <script src="{{asset('js/vehicle/model_table.js')}}"></script>
@endsection

