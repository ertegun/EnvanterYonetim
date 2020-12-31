@extends('front.layouts.master')
@section('title',"Kullanıcı Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.user.content.main')
@endsection
@section("script")
    <script>
        var user_table_ajax_url = "{{route('user_table_ajax')}}";
        var getDepartments_url = "{{route('getDepartments')}}";
        var user_create_ajax_url = "{{route('user_create_ajax')}}";
        function routeOwnerPageUrl(user_id){
            var second = 3;
            $.counter = function(){
                if(second > 1){
                    second--;
                    $('#delayTime').text(second);
                }
                else{
                    var url = "{{route('owner_create',['id' => "+user+"])}}";
                    url = url.replace('+user+',user_id);
                    $(location).attr('href',url);
                }
            }
            $('#delayTime').text(second);
            setInterval("$.counter()", 1000);
        }
    </script>
    <script src="{{ asset('js/user/user_table.js') }}"></script>
    <script src="{{asset('js/user/user_crud.js')}}"></script>
@endsection
