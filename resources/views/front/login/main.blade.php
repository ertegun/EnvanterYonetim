<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Grup ARGE Envanter Yönetim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}"/>
    </head>
    <body class="text-center">
        <form class="form-signin" method="post" action="{{route('login_result')}}">
            @csrf
            <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Envanter Yönetim Giriş</h1>
            <label for="user_name" class="sr-only">Kullanıcı Adı</label>
            <input type="text" value="{{Session::get('rem_name')}}" name="user_name" id="user_name" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
            <label for="password"  class="sr-only">Şifre</label>
            <input type="password" value="{{Session::get('rem_pass')}}" name="password" id="password" class="form-control" placeholder="Şifre" required>
            <div class="checkbox mb-3">
                <label><input type="checkbox" name="remember" @if(Session::get('rem_name')){{'checked'}}@endif>Beni Hatırla</label>
            </div>
            @if(Cookie::get('error'))
                <div class="alert alert-danger" role="alert">{{Cookie::get('error')}}</div>
            @endif
            <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
            <p class="mt-5 mb-3 text-muted">&copy; Grup ARGE 2020</p>
        </form>
    </body>
</html>
