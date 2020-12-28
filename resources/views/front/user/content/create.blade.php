<div class="col-12 col-md-10 col-lg-8 col-xl-7 mt-3 mb-3 mx-auto">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}">Ana Sayfa</a></li>
                <li class="breadcrumb-item"><a href="{{route('user')}}">Kullanıcı Yönetim</a></li>
                <li class="breadcrumb-item active" aria-current="page">Yeni Kullanıcı</li>
            </ol>
        </nav>
        <div class="col-12">
            <form action="{{ route('user_create_result') }}" method="POST">
                @csrf
                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select">Departman</label>
                    </div>
                    <select class="custom-select" name="dep_id" required>
                        @if(old('dep_id'))
                            @foreach($departments as $write)
                                @if($write->id==old('dep_id'))
                                    <option value="{{$write->id}}" selected>{{$write->name}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="" disabled selected hidden>Seçiniz...</option>
                        @endif
                        @foreach ($departments as $write)
                            @if($write->id!=old('dep_id'))
                                <option value="{{$write->id}}">{{$write->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="name">Ad Soyad</label>
                    </div>
                    <input name="name" id="name" value="{{old('name')}}" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                </div>
                <div class="input-group mb-3">
                    <input name="email" type="text" class="form-control" value="{{old('email')}}" placeholder="Örn:taha.yerlikaya" aria-describedby="email_aria" required>
                    <div class="input-group-append">
                        <span class="input-group-text" id='email_aria'>@gruparge.com</span>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="row my-3">
                    <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-3 ml-auto">
                        <button class="btn btn-success btn-block" type="submit">Ekle</button>
                    </div>
                    <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-3 mr-3">
                        <a href="{{ route('user') }}" class="btn btn-primary btn-block">Geri Dön</a>
                    </div>
                </div>
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
