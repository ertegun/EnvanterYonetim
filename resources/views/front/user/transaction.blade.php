@extends('front.layouts.master')
@section('title',"Kullanıcı Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.user.content.transaction')
@endsection
@section("script")
    <script src="{{ asset('js/user/user_transaction.js') }}"></script>
@endsection
