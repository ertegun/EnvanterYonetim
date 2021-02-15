<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title>Grup ARGE Envanter Yönetim</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-colvis-1.6.4/b-html5-1.6.4/b-print-1.6.4/fc-3.3.1/r-2.2.6/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/2e01f801f2.js" crossorigin="anonymous"></script>
    </head>
    <body class="text-center">
        <div class="col-12 col-sm-9 col-md-8 col-lg-7 col-xl-6 mx-auto">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Şifre Sıfırlama</li>
                    </ol>
                </nav>
                <form action="{{ route('reset_password_confirm') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Yeni Şifre</label>
                            </div>
                            <input name="password" type="password" minlength="5" maxlength="13" placeholder="Şifre" class="reset_password_control form-control" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Yeni Şifre Tekrar</label>
                            </div>
                            <input name="password_repeat" type="password" minlength="5" maxlength="13" placeholder="Şifre Tekrar" class="reset_password_control form-control" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="reset_button" class="btn btn-success" type="submit" disabled="true">Şifremi Sıfırla</button>
                    </div>
                    <input type="hidden" name="token" value="{{$token}}">
                </form>
            </div>
        </div>
        @if (Cookie::get('error'))
            <div class="alert alert-dismissible fade show alert-error text-center" role="alert">
                <b class="mx-auto">{{Cookie::get('error')}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px 7px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
            $('.reset_password_control').on('keyup',function(event){
                var pass_1 = $('.reset_password_control')[0]['value'];
                var pass_2 = $('.reset_password_control')[1]['value'];
                if( pass_1.length>4 && pass_2.length>4){
                    if(pass_1 == pass_2){
                        $('#reset_button').removeAttr('disabled');
                        $('.reset_password_control').removeClass('border-danger text-danger');
                    }
                    else{
                        $('#reset_button').attr('disabled','true');
                        $('.reset_password_control').addClass('border-danger text-danger');
                    }
                }
                else{
                    $('#reset_button').attr('disabled','true');
                    $('.reset_password_control').addClass('border-danger text-danger');
                }
            });
        </script>
    </body>
</html>
