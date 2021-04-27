@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Demirbaş")
@section('fixture_active',"active")
@section('content')
    @include('front.fixture.main.card')
    @include('front.fixture.main.modal.create')
@endsection



@section("script")
    <script>
        var fixture_table_ajax_url = "{{route('fixture_table_ajax')}}";
        var getFixtureElements_url = "{{route('getFixtureElements')}}";
        var get_sections_url       = "{{route('getSections')}}";
        var check_barcode_url       = "{{route('checkBarcode')}}";
    </script>
    <script src="{{asset('js/ellipsis.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/bill.js')}}"></script>
    <script src="{{asset('js/telephone_mask.js')}}"></script>
    <script src="{{asset('js/fixture/main.js')}}"></script>
    <script src="{{asset('js/fixture/main_table.js')}}"></script>
@endsection

