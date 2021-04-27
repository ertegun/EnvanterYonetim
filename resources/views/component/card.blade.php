<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            @yield('breadcrumb','')
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        @yield('table','')
        <div class="row my-3">
            @yield('card_link','')
        </div>
    </div>
</div>
