<div class="col-12 col-md-10 col-lg-8 col-xl-7 mt-3 mb-3 mx-auto">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}">Ana Sayfa</a></li>
                <li class="breadcrumb-item"><a href="{{route('user')}}">Kullanıcı Yönetim</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kullanıcı Düzenleme</li>
            </ol>
        </nav>
        <div class="col-12">
            <form action="{{ route('user_update_result') }}" method="POST">
                @csrf
                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select">Departman</label>
                    </div>
                    <select class="custom-select" name="dep_id" required>
                        <option value="{{$user->dep_id}}" selected>{{$user->dep_name}}</option>
                        @foreach ($departments as $write)
                            @if($write->id!=$user->dep_id)
                                <option value="{{$write->id}}">{{$write->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="name">Ad Soyad</label>
                    </div>
                <input name="name" id="name" value="{{$user->name}}" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                </div>
                <div class="input-group mb-3">
                    <input name="email" type="text" class="form-control" value="{{$user->email}}" placeholder="Örn:taha.yerlikaya" aria-describedby="email" required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="email">@gruparge.com</span>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-5 col-sm-3 col-md-4 col-xl-3 ml-auto">
                        <button class="btn btn-success btn-block" type="submit" >Güncelle</button>
                    </div>
                    <div class="col-5 col-sm-3 col-md-4 col-xl-3">
                        <a href="{{route("user")}}" class="btn btn-primary btn-block">Geri Dön</a>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$user->id}}">
            </form>
        </div>
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



