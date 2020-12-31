<div class="card">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Kullanıcı</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        <table id="userTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="width: 100%;"></table>
        <div class="row my-3">
            <div class="col-5 col-sm-4 col-lg-2 col-xl-2 mr-auto">
                <a href="{{ route('department') }}" class="btn btn-info btn-block">Departmanlar</a>
            </div>
            <div class="col-5 col-sm-4 col-lg-2 col-xl-2 ml-auto">
                <button type="button" data-toggle="modal" data-target="#userCreateModal" class="btn btn-sm btn-success btn-block">Yeni Kullanıcı</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="routingModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document" style="top: 25%">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3> Oluşturduğunuz Kullanıcı İçin Zimmet Atama Sayfasına Yönlendiriliyorsunuz...</h3></br>
                <b id="delayTime" class=" text-danger mt-1" style="font-size: 45px"></b>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="userController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Kullanıcı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="userCreateForm" action="{{ route('user_create_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <b class="text-danger"><u id="userErrorMessage"></u></b>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <button onclick="CreateShowDepartment()" class="btn btn-outline-secondary" type="button">Departman</button>
                        </div>
                        <select class="form-control create_department_select" name="department_id">
                            <option ng-repeat="department in departments" value="@{{department.id}}">@{{department.name}}</option>
                        </select>
                        <input type="text" id="create_new_department" placeholder="Yeni Departman" name="new_department" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="CreateNewDepartment()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="user_update_name">Ad Soyad</label>
                        </div>
                    <input name="name" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" type="text" class="form-control" placeholder="Örn:taha.yerlikaya" aria-describedby="email" required>
                        <div class="input-group-append">
                            <span class="input-group-text">@gruparge.com</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" >Kaydet</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="userUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="userController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kullanıcı Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <button onclick="UpdateShowDepartment()" class="btn btn-outline-secondary" type="button">Departman</button>
                        </div>
                        <select class="form-control update_department_select" name="department_id">
                            <option ng-repeat="department in departments" value="@{{department.id}}">@{{department.name}}</option>
                        </select>
                        <input type="text" id="update_new_department" placeholder="Yeni Departman" name="new_department" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="UpdateNewDepartment()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="user_update_name">Ad Soyad</label>
                        </div>
                    <input name="name" id="user_update_name" type="text" class="form-control" placeholder="Örn:Taha Yerlikaya" required>
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" id="user_update_email" type="text" class="form-control" placeholder="Örn:taha.yerlikaya" aria-describedby="email" required>
                        <div class="input-group-append">
                            <span class="input-group-text">@gruparge.com</span>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="user_update_id" value="">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" >Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kullanıcı Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user_delete') }}" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <div>
                        <b><u id="user_department"></u></b> Biriminden
                        <b><u id="user_name"></u></b></br> Kullanıcısını Silmek Üzeresiniz!
                    </div>
                    <div class="my-2"><b>Silme İşlemi Geri Döndürülemez!</b></div>
                    <input type="hidden" name="id" id="user_id">
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

