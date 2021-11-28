@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Donanım Modelleri")
@section('hardware_active',"active")
@section('content')
    @include('front.hardware.content.model')
@endsection
@section("script")
    <script>
        function hardwareModelDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getHardwareModel')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#hardware_model_delete_name').text(response.name);
                    $('#hardware_model_delete_id').val(response.id);
                }
            });
        }
        function hardwareModelUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getHardwareModel')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#hardware_model_update_name').val(response.name);
                    $('#hardware_model_update_old_name').val(response.name);
                    $('#hardware_model_update_id').val(response.id);
                }
            });
        }
    </script>
    <script src="{{asset('js/hardware/model_table.js')}}"></script>
@endsection

