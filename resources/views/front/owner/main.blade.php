@extends('front.layouts.master')
@section('title',"{{$user->name}} Zimmet Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.owner.content.main')
@endsection
@section("script")
<script>
    var owner_hardware_table_ajax_url   =   "{{route('owner_hardware_table_ajax')}}";
    var owner_software_table_ajax_url   =   "{{route('owner_software_table_ajax')}}";
    var owner_common_table_ajax_url     =   "{{route('owner_common_table_ajax')}}";
    var owner_material_table_ajax_url   =   "{{route('owner_material_table_ajax')}}";
    var owner_vehicle_table_ajax_url    =   "{{route('owner_vehicle_table_ajax')}}";
    var user_id = "{{$user->id}}";
    function hardwareDrop(id,issue_time){
        $.ajax({
            type:'POST',
            url:`{{route('getHardware')}}`,
            data:{id},
            success:function(response){
                $('#hardware_drop_barcode_number').text(response.barcode_number);
                $('#hardware_drop_hardware_id').val(response.id);
                $('#hardware_drop_serial_number').text(response.serial_number);
                $('#hardware_drop_issue_time').text(issue_time);
                $('#hardware_drop_detail').html(response.detail);
                $('#hardware_drop_type').text(response.get_type.name);
                $('#hardware_drop_model').text(response.get_model.name);
            }
        });
    }
    function softwareDrop(id){
        $.ajax({
            type:'POST',
            url:`{{route('getSoftware')}}`,
            data:{id},
            dataType:'json',
            success:function(response){
                $('#software_drop_name').text(response.name);
                $('#software_drop_type').text(response.get_type.name);
                $('#software_drop_software_id').val(response.id);
            }
        });
    }
    function commonDrop(id){
        $.ajax({
            type:'POST',
            url:`{{route('getCommonItem')}}`,
            data:{id},
            dataType:'json',
            success:function(response){
                $('#common_drop_name').text(response.name);
                $('#common_drop_type').text(response.get_type.name);
                $('#common_drop_detail').html(response.detail);
                $('#common_drop_common_id').val(response.id);
            }
        });
    }
    function materialDrop(issue_id,id){
        $.ajax({
            type:'POST',
            url:`{{route('getMaterial')}}`,
            data:{id},
            success:function(response){
                $('#material_drop_type').text(response.get_type.name);
                $('#material_drop_detail').html(response.detail);
                $('#material_drop_material_id').val(response.id);
                $('#material_drop_id').val(issue_id);
            }
        });
    }
    function vehicleDrop(id){
        $.ajax({
            type:'POST',
            url:`{{route('getVehicle')}}`,
            data:{id},
            dataType:'json',
            success:function(response){
                $('#vehicle_drop_name').text(response.name);
                $('#vehicle_drop_model').text(response.get_model.name);
                $('#vehicle_drop_detail').html(response.detail);
                $('#vehicle_drop_vehicle_id').val(response.id);
            }
        });
    }
    function changeIssueTime(item_type,item_id,issue_input){
        $('#item_type').val(item_type);
        $('#item_id').val(item_id);
        $('#issue_time').val(issue_input);
        $('#old_issue_time').val(issue_input);
    }
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
    <script src="{{ asset('js/owner/user_hardware.js') }}"></script>
    <script src="{{ asset('js/owner/user_software.js') }}"></script>
    <script src="{{ asset('js/owner/user_common.js') }}"></script>
    <script src="{{ asset('js/owner/user_material.js') }}"></script>
    <script src="{{ asset('js/owner/user_vehicle.js') }}"></script>
@endsection
