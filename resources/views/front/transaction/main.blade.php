@extends('front.layouts.master')
@section('title',"İşlem Geçmişi")
@section('transaction_active',"active")
@section('content')
    @include('front.transaction.content')
@endsection
@section("script")
    <script>
        var transaction_ajax_url = "{{route('transaction_ajax')}}";
    </script>
    <script src="{{ asset('js/transaction/transaction.js') }}"></script>
@endsection
