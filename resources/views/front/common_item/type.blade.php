@extends('front.layouts.master')
@section('title',"Envanter Yönetim - Ortak Kullanım Türleri")
@section('common_item_active',"active")
@section('content')
    @include('front.common_item.content.type')
@endsection
@section("script")
    <script>
        function commonItemTypeDelete(id){
            $.ajax({
                type:'POST',
                url:`{{route('getCommonItemType')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#common_item_type_delete_name').text(response.name);
                    $('#common_item_type_delete_id').val(response.id);
                }
            });
        }
        function commonItemTypeUpdate(id){
            $.ajax({
                type:'POST',
                url:`{{route('getCommonItemType')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#common_item_type_update_name').val(response.name);
                    $('#common_item_type_update_old_name').val(response.name);
                    $('#common_item_type_update_id').val(response.id);
                }
            });
        }
    </script>
    <script src="{{asset('js/common_item/type_table.js')}}"></script>
@endsection

