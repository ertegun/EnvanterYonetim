@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Donanım Tipleri")
@section('hardware_active',"active")
@section('content')
    @include('front.hardware.content.type')
@endsection
@section("script")
    <script>
        function hardwareTypeDelete(id,name,prefix){
            $('#hardware_type_delete_name').text(name);
            $('#hardware_type_delete_prefix').text(prefix);
            $('#hardware_type_delete_id').val(id);
        }
        function hardwareTypeUpdate(id,name,prefix,total_item){
            $('#hardware_type_update_name').val(name);
            $('#hardware_type_update_old_name').val(name);
            $('#hardware_type_update_prefix').val(prefix);
            $('#hardware_type_update_old_prefix').val(prefix);
            $('#hardware_type_update_id').val(id);
            $('#hardware_type_update_total_item').val(total_item);
        }
    </script>
    <script src="{{asset('js/hardware/type_table.js')}}"></script>
@endsection

