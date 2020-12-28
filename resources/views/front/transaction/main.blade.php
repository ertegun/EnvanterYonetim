@extends('front.layouts.master')
@section('title',"İşlem Geçmişi")
@section('transaction_active',"active")
@section('content')
    @include('front.transaction.content')
@endsection
@section("script")
    <script src="{{ asset('js/transaction.js') }}"></script>
@endsection
