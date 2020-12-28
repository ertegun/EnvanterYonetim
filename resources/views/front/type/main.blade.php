@extends('front.layouts.master')
@section('title',"Tip Yönetim")
@section('inventory_active',"active")
@section('hardware_active',"active bd-sidenav-active")
@section('content')
    @include('front.type.content.main')
@endsection
@section("script")
    <script src="{{ asset('js/table.js') }}"></script>
@endsection
