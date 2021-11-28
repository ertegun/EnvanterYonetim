@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Yazılım Tipleri")
@section('software_active',"active")
@section('content')
    @include('front.software.content.type')
@endsection
@section("script")
    <script>
        function softwareTypeDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getSoftwareType')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#software_type_delete_name').text(response.name);
                    $('#software_type_delete_id').val(response.id);
                }
            })
        }
        function softwareTypeUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getSoftwareType')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#software_type_update_name').val(response.name);
                    $('#software_type_update_old_name').val(response.name);
                    $('#software_type_update_id').val(response.id);
                }
            })
        }
    </script>
    <script src="{{asset('js/software/type_table.js')}}"></script>
@endsection

