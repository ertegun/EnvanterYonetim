@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Donanım Tipleri")
@section('hardware_active',"active")
@section('content')
    @include('front.hardware.content.type')
@endsection
@section("script")
    <script>
        function hardwareTypeDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getHardwareType')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#hardware_type_delete_name').text(response.name);
                    $('#hardware_type_delete_prefix').text(response.prefix);
                    $('#hardware_type_delete_id').val(response.id);
                }
            });
        }
        function hardwareTypeUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getHardwareType')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#hardware_type_update_name').val(response.name);
                    $('#hardware_type_update_old_name').val(response.name);
                    $('#hardware_type_update_prefix').val(response.prefix);
                    $('#hardware_type_update_old_prefix').val(response.prefix);
                    $('#hardware_type_update_id').val(response.id);
                    $('#hardware_type_update_total_item').val(response.total_item);
                }
            });
        }
    </script>
    <script src="{{asset('js/hardware/type_table.js')}}"></script>
@endsection

