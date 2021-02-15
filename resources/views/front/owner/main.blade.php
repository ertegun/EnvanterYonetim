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
    function hardwareDrop(hardware_id,barcode_number,serial_number,detail,type,model,issue_time){
        $('#hardware_drop_barcode_number').text(barcode_number);
        $('#hardware_drop_hardware_id').val(hardware_id);
        $('#hardware_drop_serial_number').text(serial_number);
        $('#hardware_drop_issue_time').text(issue_time);
        $('#hardware_drop_detail').html(detail);
        $('#hardware_drop_type').text(type);
        $('#hardware_drop_model').text(model);
    }
    function softwareDrop(software_id,name,type){
        $('#software_drop_name').text(name);
        $('#software_drop_type').text(type);
        $('#software_drop_software_id').val(software_id);
    }
    function commonDrop(common_id,name,type,detail){
        $('#common_drop_name').text(name);
        $('#common_drop_type').text(type);
        $('#common_drop_detail').html(detail);
        $('#common_drop_common_id').val(common_id);
    }
    function materialDrop(id,material_id,type,detail){
        $('#material_drop_type').text(type);
        $('#material_drop_detail').html(detail);
        $('#material_drop_material_id').val(material_id);
        $('#material_drop_id').val(id);
    }
    function vehicleDrop(vehicle_id,name,model,detail){
        $('#vehicle_drop_name').text(name);
        $('#vehicle_drop_model').text(model);
        $('#vehicle_drop_detail').html(detail);
        $('#vehicle_drop_vehicle_id').val(vehicle_id);
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
