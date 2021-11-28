<div class="row">
    <div class="col-12 col-lg-8 col-xl-8 mb-3" >
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Yönetim Paneli</li>
                </ol>
            </nav>
            <div class="col-12 mx-auto mt-3">
                <table class="table table-sm table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                        <th>Kullanıcı Adı</th>
                        <th>Yetkili Adı</th>
                        <th>Yetkisi</th>
                        <th>İşlemler</th>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{$admin->user_name}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->getRole->name}}</td>
                            <td>
                                <span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Yetkiliyi Düzenle">
                                    <a data-toggle="modal" data-target="#adminUpdateModal" onclick="adminUpdate('{{$admin->id}}')" class="text-decoration-none">
                                        <i class="fas fa-edit table-icon text-primary"></i>
                                    </a>
                                </span>
                                <span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Yetkiliye Yeni Şifre Oluştur">
                                    <a data-toggle="modal" data-target="#adminUpdatePasswordModal" onclick="adminUpdatePassword('{{$admin->id}}')" class="text-decoration-none">
                                        <i class="fas fa-key table-icon text-warning"></i>
                                    </a>
                                </span>
                                <span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Yetkiliyi Siler!">
                                    <a data-toggle="modal" data-target="#adminDeleteModal" onclick="adminDelete('{{$admin->id}}')" class="text-decoration-none">
                                        <i class="fas fa-trash-alt table-icon text-danger"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row my-3">
                    <div class="col-6 col-sm-5 col-lg-3 col-xl-3 ml-auto">
                        <button type="button" data-toggle="modal" data-target="#adminCreateModal" class="btn btn-sm btn-success btn-block">Yeni Yetkili</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 col-xl-4">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Yetkiler</li>
                </ol>
            </nav>
            <div class="col-12 mx-auto mt-2">
                <h4>Yönetici</h4>
                <p>Tüm İşlemleri Gerçekleştirir</p>
                <h4>Bilgi İşlem</h4>
                <p>Donanım/Yazılım/Ortak Kullanım/Zimmet Fişi İşlemlerine Erişim Sağlayabilir.</p>
                <h4>Üretim</h4>
                <p>Malzeme/Araç İşlemlerine Erişim Sağlayabilir.</p>
                <h4>İnsan Kaynakları</h4>
                <p>Departman/Kullanıcı İşlemlerine Erişim Sağlayabilir.</p>
                <h4>Tüm Yetkililer</h4>
                <p>Kullanıcı Paneli, Zimmet Paneli ve İşlem Geçmişi Paneline Erişim Sağlayabilir.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="adminCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="adminController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Yetkili</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adminCreateForm" action="{{ route('admin_create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Yetki Türü</label>
                        </div>
                        <select class="form-control create_role_select" name="role_id">
                            <option ng-repeat="role in roles" value="@{{role.id}}">@{{role.name}}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Ad Soyad</label>
                        </div>
                    <input name="name" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Kullanıcı Adı</label>
                        </div>
                    <input name="user_name" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" type="text" class="form-control" placeholder="Örn:taha.yerlikaya" aria-describedby="email" required>
                        <div class="input-group-append">
                            <span class="input-group-text">@gruparge.com</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Şifre</label>
                        </div>
                        <input name="password" type="password" minlength="5" maxlength="13" placeholder="Şifre" class="create_password_control form-control" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Şifre Tekrar</label>
                        </div>
                        <input name="password_repeat" type="password" minlength="5" maxlength="13" placeholder="Şifre Tekrar" class="create_password_control form-control" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary password_button" type="button"><i class="fa fa-eye-slash"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="create_button" class="btn btn-success" type="submit" disabled="true" >Oluştur</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="adminUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="adminController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yetkili Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adminUpdateForm" action="{{ route('admin_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Yetki Türü</label>
                        </div>
                        <select class="form-control update_role_select" name="role_id">
                            <option ng-repeat="role in roles" value="@{{role.id}}">@{{role.name}}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Ad Soyad</label>
                        </div>
                    <input id="admin_update_name" name="name" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Kullanıcı Adı</label>
                        </div>
                    <input id="admin_update_user_name" name="user_name" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                    </div>
                    <div class="input-group mb-3">
                        <input id="admin_update_email" name="email" type="text" class="form-control" placeholder="Örn:taha.yerlikaya" aria-describedby="email" required>
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
                    <input id="admin_update_id" name="admin_id" type="hidden">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="adminUpdatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="adminController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yetkili Şifre Güncelle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin_update_password') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                    <input id="admin_id" type="hidden" name="admin_id">
                </div>
                <div class="modal-footer">
                    <button id="update_button" class="btn btn-success" type="submit" disabled="true" >Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="adminDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yetkili Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adminDeleteForm" action="{{ route('admin_delete') }}" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <div>
                        <b><u>Kullanıcı Adı:</u></b> <span id="admin_delete_user_name"></span></br>
                        <b><u>Yetkili Adı:</u></b> <span id="admin_delete_name"></span></br>
                        <b><u>Yetkisi:</u></b> <span id="admin_delete_role"></span></br>
                    </div>
                    <div class="my-2">
                        <u>Yetkiliyi Silmek Üzeresiniz!</u></br>
                        <b>Silme İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="admin_id" id="admin_delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Sil</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
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

