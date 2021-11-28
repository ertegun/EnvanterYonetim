@extends('front.layouts.master')
@section('title', 'Kullanıcı Yönetim')
@section('user_active', 'active')
@section('content')
    @include('front.user.content.main')
@endsection
@section('script')
    <script>
        var user_table_ajax_url = "{{ route('user_table_ajax') }}";
        var getDepartments_url = "{{ route('getDepartments') }}";
        /*var user_create_ajax_url = "route('user_create_ajax')";
        function routeOwnerPageUrl(user_id){
            var second = 3;
            $.counter = function(){
                if(second > 1){
                    second--;
                    $('#delayTime').text(second);
                }
                else{
                    var url = "{{ route('owner_create', ['id' => '+user+']) }}";
                    url = url.replace('+user+',user_id);
                    $(location).attr('href',url);
                }
            }
            $('#delayTime').text(second);
            setInterval("$.counter()", 1000);
        }*/
        function userUpdate(id) {
            $.ajax({
                type: 'POST',
                url: `{{route('getUser')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    let email = response.email;
                    email = email.split('@')[0];
                    //$('.update_department_select').select2("val", department_id);
                    $('.update_department_select').val(response.department_id).trigger('change');
                    $('#user_update_name').val(response.name);
                    $('#user_update_email').val(email);
                    $('#user_update_id').val(response.id);
                }
            })
        }

        function userDelete(id) {
            $.ajax({
                type: 'POST',
                url: `{{route('getUser')}}`,
                data:{id},
                dataType:'json',
                success:function(response){
                    $('#user_id').val(response.id);
                    $('#user_name').text(response.name);
                    $('#user_department').text(response.get_department.name);
                }
            })
        }
    </script>
    <script src="{{ asset('js/user/user_table.js') }}"></script>
    <script src="{{ asset('js/user/user_crud.js') }}"></script>
@endsection
