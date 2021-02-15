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
    </head>
    <body class="text-center">
        <form class="form-signin" method="post" action="{{route('login_result')}}">
            @csrf
            <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Envanter Yönetim Giriş</h1>
            <label for="user_name" class="sr-only">Kullanıcı Adı</label>
            <input type="text" value="{{Session::get('user_name')}}" name="user_name" id="user_name" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
            <label for="password"  class="sr-only">Şifre</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Şifre" required>
            <div class="checkbox mb-3">
                <label><input type="checkbox" name="remember" @if(Session::get('user_name')){{'checked'}}@endif>Beni Hatırla</label>
            </div>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
            @endif
            <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
            <button type="button" data-toggle="modal" data-target="#forgetModal" class="btn btn-sm btn-warning btn-block">Şifremi Unuttum</button>
            <p class="mt-5 mb-3 text-muted">&copy; Grup ARGE 2020</p>
        </form>
        <div class="modal fade" id="forgetModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Şifremi Unuttum</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('forget_password') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input name="email" type="text" minlength="6" maxlength="30" class="form-control" placeholder="Örn:taha.yerlikaya" aria-describedby="email" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">@gruparge.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Mail Gönder</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                        </div>
                        <input type="hidden" name="token" value="{{Str::random(32)}}">
                    </form>
                </div>
            </div>
        </div>
        @if (Cookie::get('success'))
            <div class="alert alert-dismissible fade show alert-success text-center" role="alert">
                <b class="mx-auto">{{Cookie::get('success')}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px 7px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Cookie::get('error'))
            <div class="alert alert-dismissible fade show alert-error text-center" role="alert">
                <b class="mx-auto">{{Cookie::get('error')}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px 7px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </body>
</html>
