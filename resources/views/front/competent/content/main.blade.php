<div class="row">
    <div class="col-12 col-lg-8 col-xl-8 mb-3" >
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Yetkili Paneli</li>
                </ol>
            </nav>
            <div class="col-12 mx-auto">
                <div class="card mb-3 border-success">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-success">
                            <li class="breadcrumb-item active text-white" aria-current="page">Hesap Bilgileri</li>
                        </ol>
                    </nav>
                    <form action="{{ route('competent_update') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Ad Soyad</label>
                                </div>
                            <input id="competent_update_name" value="{{Auth::user()->name}}" name="name" type="text" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Kullanıcı Adı</label>
                                </div>
                            <input id="competent_update_user_name" value="{{Auth::user()->user_name}}" name="user_name" type="text" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <input id="competent_update_email" value="{{Str::before(Auth::user()->email, '@')}}" name="email" type="text" class="form-control" aria-describedby="email" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">@gruparge.com</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Eski Şifre</label>
                                </div>
                                <input name="current_password" type="password" minlength="5" maxlength="13" placeholder="Eski Şifre" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Güncelle</button>
                        </div>
                    </form>
                </div>
                <div class="card mb-3 border-warning">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-warning">
                            <li class="breadcrumb-item active text-white" aria-current="page">Şifre Güncelleme</li>
                        </ol>
                    </nav>
                    <form action="{{ route('competent_update_password') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Eski Şifre</label>
                                </div>
                                <input name="current_password" type="password" minlength="5" maxlength="13" placeholder="Şifre" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Şifre</label>
                                </div>
                                <input name="password" type="password" minlength="5" maxlength="13" placeholder="Şifre" class="update_password_control form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Şifre Tekrar</label>
                                </div>
                                <input name="password_repeat" type="password" minlength="5" maxlength="13" placeholder="Şifre Tekrar" class="update_password_control form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="update_button" class="btn btn-warning" type="submit" disabled="true" >Güncelle</button>
                        </div>
                    </form>
                </div>
                <div class="card mb-3 border-danger">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-danger">
                            <li class="breadcrumb-item active text-white" aria-current="page">Hesabı Sil</li>
                        </ol>
                    </nav>
                    <form id="deleteForm" action="{{ route('competent_delete') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <ul>
                                <li>Hesap silme işlemi geri döndürülemez.</li>
                                <li>Hesabınız silindikten sonra yetkili giriş sayfasına yönlendirileceksiniz.</li>
                                <li>Hesabınız silindikten sonra yeni hesap açmak isterseniz yöneticinize başvurunuz.</li>
                            </ul>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Şifre</label>
                                </div>
                                <input name="current_password" type="password" minlength="5" maxlength="13" placeholder="Şifre" class="delete_password_control form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Şifre Tekrar</label>
                                </div>
                                <input name="current_password_repeat" type="password" minlength="5" maxlength="13" placeholder="Şifre Tekrar" class="delete_password_control form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button id="delete_button" class="btn btn-danger" type="submit" disabled="true" >Hesabımı Sil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 col-xl-4">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Yetkileriniz</li>
                </ol>
            </nav>
            <div class="col-12 mx-auto mt-2">
                @can('isIT')
                    <h4>Bilgi İşlem</h4>
                    <p>Donanım/Yazılım/Ortak Kullanım/Zimmet Fişi İşlemlerine Erişim Sağlayabilir.</p>
                @endcan
                @can('isProducer')
                    <h4>Üretim</h4>
                    <p>Malzeme/Araç İşlemlerine Erişim Sağlayabilir.</p>
                @endcan
                @can('isHR')
                    <h4>İnsan Kaynakları</h4>
                    <p>Departman/Kullanıcı İşlemlerine Erişim Sağlayabilir.</p>
                @endcan
                <h4>Tüm Yetkililer</h4>
                <p>Kullanıcı Paneli, Zimmet Paneli ve İşlem Geçmişi Paneline Erişim Sağlayabilir.</p>
            </div>
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

