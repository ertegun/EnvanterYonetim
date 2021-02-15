@extends('front.layouts.master')
@section('title',"Yetkili Paneli")
@section('competent_active',"active")
@section('content')
    @include('front.competent.content.main')
@endsection
@section("script")
    <script>
        $(document).ready(function(){
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
        $('.update_password_control').on('keyup',function(event){
            var pass_1 = $('.update_password_control')[0]['value'];
            var pass_2 = $('.update_password_control')[1]['value'];
            if( pass_1.length>5 && pass_2.length>5){
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
        $('.delete_password_control').on('keyup',function(event){
            var pass_1 = $('.delete_password_control')[0]['value'];
            var pass_2 = $('.delete_password_control')[1]['value'];
            if( pass_1.length>4 && pass_2.length>4){
                if(pass_1 == pass_2){
                    $('#delete_button').removeAttr('disabled');
                    $('.delete_password_control').removeClass('border-danger text-danger');
                }
                else{
                    $('#delete_button').attr('disabled','true');
                    $('.delete_password_control').addClass('border-danger text-danger');
                }
            }
            else{
                $('#delete_button').attr('disabled','true');
                $('.delete_password_control').addClass('border-danger text-danger');
            }
        });
        $('#delete_button').on('click',function (event) {
            var save = confirm("Hesabınız Silinecek Onaylıyor musunuz?");
            if (save) {
                document.deleteForm.submit();
            }
        });
    </script>
@endsection
