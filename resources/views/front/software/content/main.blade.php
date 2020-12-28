<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Yazılım</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        <table id="softwareTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="width: 100%;"></table>
        <div class="row my-3">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mb-2">
                <a href="{{ route('software_type') }}" class="btn btn-sm btn-primary btn-block">Türler</a>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <button type="button" data-toggle="modal" data-target="#softwareCreateModal" class="btn btn-sm btn-success btn-block">Yeni Yazılım</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Yazılım</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="softwareCreateShowType()" class="btn btn-outline-secondary" type="button">Tür</button>
                        </div>
                        <select class="software_create_type_select" id="create_type_select" name="type_id" required>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        <input type="text" id="software_create_new_type" placeholder="Yeni Tür" name="new_type" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="softwareCreateNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Yazılım Adı</span>
                        </div>
                        <input placeholder="Yazılım Adı" class="form-control" id="software_create_name" name="name" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alınış Zamanı</span>
                        </div>
                        <input type="date" value="{{date('Y-m-d')}}" class="form-control" id="software_create_start_time" name="start_time" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="softwareCreateEnableLicenseTime()" class="btn btn-outline-secondary" type="button">Süreli</button>
                        </div>
                        <input type="number" value="1" min="1" max="10" class="form-control" id="software_create_license_time" name="license_time" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Yıl</span>
                            <button onclick="softwareCreateDisableLicenseTime()" class="btn btn-outline-secondary" type="button">Süresiz</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Adet</span>
                        </div>
                        <input type="number" value="1" min="1" max="10" class="form-control" id="software_create_piece" name="piece" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Ekle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yazılım Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="softwareUpdateShowType()" class="btn btn-outline-secondary" type="button">Tür</button>
                        </div>
                        <select class="software_update_type_select" id="update_type_select" name="type_id" required>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        <input type="text" id="software_update_new_type" placeholder="Yeni Tür" name="new_type" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="softwareUpdateNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Yazılım Adı</span>
                        </div>
                        <input class="form-control" id="software_update_name" name="name" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alınış Zamanı</span>
                        </div>
                        <input type="date" class="form-control" id="software_update_start_time" name="start_time" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="softwareUpdateEnableLicenseTime()" class="btn btn-outline-secondary" type="button">Süreli</button>
                        </div>
                        <input type="number" value="1" min="1" max="10" class="form-control" id="software_update_license_time" name="license_time" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Yıl</span>
                            <button onclick="softwareUpdateDisableLicenseTime()" class="btn btn-outline-secondary" type="button">Süresiz</button>
                        </div>
                    </div>
                    <input type="hidden" id="software_update_id" name="id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yazılım Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_delete') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Yazılım Adı:</u></b> <span id="software_delete_name"></span></br>
                        <b><u>Türü:</u></b> <span id="software_delete_type"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Yazılımını Silmek Üzeresiniz!</u></br>
                        <b>Silme İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="id" id="software_delete_id">
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
