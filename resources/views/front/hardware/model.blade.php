@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Donanım Modelleri")
@section('hardware_active',"active")
@section('content')
    @include('front.hardware.content.model')
@endsection
@section("script")
    <script>
        function hardwareModelDelete(id,name){
            $('#hardware_model_delete_name').text(name);
            $('#hardware_model_delete_id').val(id);
        }
        function hardwareModelUpdate(id,name){
            $('#hardware_model_update_name').val(name);
            $('#hardware_model_update_old_name').val(name);
            $('#hardware_model_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/hardware/model_table.js')}}"></script>
@endsection

