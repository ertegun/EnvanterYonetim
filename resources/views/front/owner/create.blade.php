@extends('front.layouts.master')
@section('title',"Zimmet Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.owner.content.create')
@endsection
@section("script")
    <script>
        var getHardwareElements_url     =   "{{route('getHardwareElements')}}";
        var get_useable_hardware_url    =   "{{route('get_useable_hardware')}}";
        var hardware_create_ajax_url    =   "{{route('hardware_create_ajax')}}";

        var getSoftwareElements_url     =   "{{route('getSoftwareElements')}}";
        var get_useable_software_url    =   "{{route('get_useable_software')}}";
        var software_create_ajax_url    =   "{{route('software_create_ajax')}}";

        var getCommonItemElements_url   =   "{{route('getCommonItemElements')}}";
        var get_useable_common_item_url =   "{{route('get_useable_common_item')}}";
        var common_item_create_ajax_url =   "{{route('common_item_create_ajax')}}";

        var getMaterialElements_url     =   "{{route('getMaterialElements')}}";
        var get_useable_material_url    =   "{{route('get_useable_material')}}";
        var material_create_ajax_url    =   "{{route('material_create_ajax')}}";

        var getVehicleElements_url      =   "{{route('getVehicleElements')}}";
        var get_useable_vehicle_url     =   "{{route('get_useable_vehicle')}}";
        var vehicle_create_ajax_url     =   "{{route('vehicle_create_ajax')}}";
    </script>
    <script src="{{asset('js/owner/hardware_select.js')}}"></script>
    <script src="{{asset('js/owner/software_select.js')}}"></script>
    <script src="{{asset('js/owner/common_item_select.js')}}"></script>
    <script src="{{asset('js/owner/material_select.js')}}"></script>
    <script src="{{asset('js/owner/vehicle_select.js')}}"></script>
@endsection
