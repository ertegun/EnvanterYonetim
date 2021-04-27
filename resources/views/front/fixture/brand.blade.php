@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Demirbaş Markaları")
@section('fixture_active',"active")
@section('content')
    @include('front.fixture.content.brand')
@endsection
@section("script")
    <script>
        function fixtureBrandDelete(id,name){
            $('#fixture_brand_delete_name').text(name);
            $('#fixture_brand_delete_id').val(id);
        }
        function fixtureBrandUpdate(id,name){
            $('#fixture_brand_update_name').val(name);
            $('#fixture_brand_update_old_name').val(name);
            $('#fixture_brand_update_id').val(id);
        }
    </script>
    <script src="{{asset('js/fixture/brand_table.js')}}"></script>
@endsection

