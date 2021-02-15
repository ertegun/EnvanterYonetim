@extends('front.layouts.master')
@section('title',"Yönetim Paneli")
@section('admin_active',"active")
@section('content')
    @include('front.admin.content.main')
@endsection
@section("script")
    <script>
        var getRoles_url = "{{route('getRoles')}}";
        function adminUpdate(id,user_name,name,email,role_id){
            email = email.split('@')[0];
            $('.update_role_select').select2("val",role_id);
            $('#admin_update_user_name').val(user_name);
            $('#admin_update_name').val(name);
            $('#admin_update_email').val(email);
            $('#admin_update_id').val(id);
        }
        function adminUpdatePassword(id){
            $('#admin_id').val(id);
        }
        function adminDelete(id,user_name,name,role){
            $('#admin_delete_id').val(id);
            $('#admin_delete_name').text(name);
            $('#admin_delete_user_name').text(user_name);
            $('#admin_delete_role').text(role);
        }
        NgApp.controller('adminController',function($http,$scope){
            $http.post(getRoles_url).then(function(response){
                $scope.roles    =   response.data.roles;
            });
        });
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('.update_role_select').select2({
                dropdownParent: $('#adminUpdateModal'),
            });
            $('.create_role_select').select2({
                dropdownParent: $('#adminCreateModal'),
            });
            $(".password_button").on('click', function(event) {
                event.preventDefault();
                if($(this).parents(1).children('input.form-control').attr("type") == "text"){
                    $(this).parents(1).children('input.form-control').attr('type', 'password');
                    $(this).children('i').addClass( "fa-eye-slash" );
                    $(this).children('i').removeClass( "fa-eye" );
                }else if($(this).parents(1).children('input.form-control').attr('type') == "password"){
                    $(this).parents(1).children('input.form-control').attr('type', 'text');
                    $(this).children('i').removeClass( "fa-eye-slash" );
                    $(this).children('i').addClass( "fa-eye" );
                }
            });
        });
        $('.create_password_control').on('keyup',function(event){
            var pass_1 = $('.create_password_control')[0]['value'];
            var pass_2 = $('.create_password_control')[1]['value'];
            if( pass_1.length>5 && pass_2.length>5){
                if(pass_1 == pass_2){
                    $('#create_button').removeAttr('disabled');
                    $('.create_password_control').removeClass('border-danger text-danger');
                }
                else{
                    $('#create_button').attr('disabled','true');
                    $('.create_password_control').addClass('border-danger text-danger');
                }
            }
            else{
                $('#create_button').attr('disabled','true');
                $('.create_password_control').addClass('border-danger text-danger');
            }
        });
        $('.update_password_control').on('keyup',function(event){
            var pass_1 = $('.update_password_control')[0]['value'];
            var pass_2 = $('.update_password_control')[1]['value'];
            if( pass_1.length>4 && pass_2.length>4){
                if(pass_1 == pass_2){
                    $('#update_button').removeAttr('disabled');
                    $('.update_password_control').removeClass('border-danger text-danger');
                }
                else{
                    $('#update_button').attr('disabled','true');
                    $('.update_password_control').addClass('border-danger text-danger');
                }
            }
            else{
                $('#update_button').attr('disabled','true');
                $('.update_password_control').addClass('border-danger text-danger');
            }
        });
    </script>
@endsection
