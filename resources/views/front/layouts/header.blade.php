<!DOCTYPE html>
<html lang="tr" ng-app="NgApp">
    <head>
        <title>Grup ARGE Envanter Yönetim - @yield('title',"Sayfa Bulunamadı")</title>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-colvis-1.6.4/b-html5-1.6.4/b-print-1.6.4/fc-3.3.1/r-2.2.6/datatables.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/docs.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" />
        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-colvis-1.6.4/b-html5-1.6.4/b-print-1.6.4/fc-3.3.1/r-2.2.6/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/tr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://kit.fontawesome.com/2e01f801f2.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/settings.js')}}"></script>
    </head>
    <body>
        <header class="navbar navbar-expand-md navbar-dark bg-primary flex-md-row bd-navbar">
            <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 mr-3 collapsed" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('homepage') }}">Ana Sayfa</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link disabled text-light" href="#" tabindex="-1" aria-disabled="true">{{strtok(Session::get('name'), " ").'(Yönetici)'}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('logout') }}">Çıkış Yap
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </header>
        <div class="container-fluid">
            <div class="row flex-xl-nowrap">
                <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
                    <nav class="collapse bd-links" id="bd-docs-nav">
                        <div class="bd-toc-item @yield('user_active')" >
                            <a class="bd-toc-link" href="{{ route('user') }}">Kullanıcı</a>
                        </div>
                        <div class="bd-toc-item @yield('hardware_active')" >
                            <a class="bd-toc-link" href="{{ route('hardware') }}">Donanım</a>
                        </div>
                        <div class="bd-toc-item @yield('software_active')" >
                            <a class="bd-toc-link" href="{{ route('software') }}">Yazılım</a>
                        </div>
                        <div class="bd-toc-item @yield('common_item_active')" >
                            <a class="bd-toc-link" href="{{ route('common_item') }}">Ortak Kullanım</a>
                        </div>
                        <div class="bd-toc-item @yield('material_active')" >
                            <a class="bd-toc-link" href="{{ route('material') }}">Malzeme</a>
                        </div>
                        <div class="bd-toc-item @yield('transaction_active')" >
                            <a class="bd-toc-link" href="{{ route('transaction') }}">İşlem Geçmişi</a>
                        </div>
                    </nav>
                </div>
                <main class="col-12 col-sm-12 col-md-9 col-xl-10 py-md-3 px-md-4 bd-content" role="main">

