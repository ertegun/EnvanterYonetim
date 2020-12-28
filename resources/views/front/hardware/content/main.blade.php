<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Donanım</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        <table id="hardwareTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="width: 100%;"></table>
        <div class="row my-3">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mb-2">
                <a href="{{ route('hardware_type') }}" class="btn btn-sm btn-primary btn-block">Tipler</a>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mr-auto mb-2">
                <a href="{{ route('hardware_model') }}" class="btn btn-sm btn-primary btn-block">Modeller</a>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <button type="button" data-toggle="modal" data-target="#hardwareCreateModal" class="btn btn-sm btn-success btn-block">Yeni Ekipman</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hardwareCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="hardwareController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Donanım</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('hardware_create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="hardwareCreateShowType()" class="btn btn-outline-secondary" type="button">Tip</button>
                        </div>
                        <select class="hardware_create_type_select" id="create_type_select" name="type_id" required>
                            <option ng-repeat="type in types" data-prefix="@{{type.prefix}}" value="@{{type.id}}">@{{type.name}}</option>
                        </select>
                        <input type="text" id="hardware_create_new_type" placeholder="Yeni Tip" name="new_type" class="form-control" disabled style="display: none">
                        <input type="text" id="hardware_create_new_type_prefix" placeholder="Yeni Tip Ön Eki" name="new_type_prefix" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="hardwareCreateNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="hardwareCreateShowModel()" class="btn btn-outline-secondary" type="button">Model</button>
                        </div>
                        <select class="hardware_create_model_select" id="create_model_select" name="model_id" required>
                            <option ng-repeat="model in models" value="@{{model.id}}">@{{model.name}}</option>
                        </select>
                        <input type="text" id="hardware_create_new_model" placeholder="Yeni Model" name="new_model" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="hardwareCreateNewModel()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="hardwareCreateOpenBarcodeNumber()" class="btn btn-outline-secondary" type="button">Barkod No</button>
                            <span id="hardware_create_barcode_number_prepend" class="input-group-text"></span>
                        </div>
                        <input value="" class="form-control" id="hardware_create_barcode_number_info" name="barcode_number" required>
                        <div class="input-group-append">
                            <button onclick="hardwareCreateCloseBarcodeNumber()" class="btn btn-outline-secondary" type="button">Otomatik</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Seri No</span>
                        </div>
                        <input value="" class="form-control" id="hardware_create_serial_number" name="serial_number" aria-describedby="serial_help">
                    </div>
                    <small id="serial_help" class="form-text text-muted mb-3">Örn:SN:012345</small>
                    <label for="detail">Detay</label>
                    <div class="input-group mb-3">
                        <textarea id="hardware_create_detail" rows="5" maxlength="255" class="form-control" aria-label="With textarea" name="detail" style="resize: none;"></textarea>
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
<div class="modal fade" id="hardwareUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="hardwareController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donanım Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('hardware_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="hardwareUpdateShowType()" class="btn btn-outline-secondary" type="button">Tip</button>
                        </div>
                        <select class="hardware_update_type_select" id="update_type_select" name="type_id" required>
                            <option ng-repeat="type in types" data-prefix="@{{type.prefix}}" value="@{{type.id}}">@{{type.name}}</option>
                        </select>
                        <input type="text" id="hardware_update_new_type" placeholder="Yeni Tip" name="new_type" class="form-control" disabled style="display: none">
                        <input type="text" id="hardware_update_new_type_prefix" placeholder="Yeni Tip Ön Eki" name="new_type_prefix" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="hardwareUpdateNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="hardwareUpdateShowModel()" class="btn btn-outline-secondary" type="button">Model</button>
                        </div>
                        <select class="hardware_update_model_select" id="update_model_select" name="model_id" required>
                            <option ng-repeat="model in models" value="@{{model.id}}">@{{model.name}}</option>
                        </select>
                        <input type="text" id="hardware_update_new_model" placeholder="Yeni Model" name="new_model" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="hardwareUpdateNewModel()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Barkod No</span>
                            <span id="hardware_update_barcode_number_prepend" class="input-group-text"></span>
                        </div>
                        <input value="" class="form-control" id="hardware_update_barcode_number_info" name="barcode_number" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Seri No</span>
                        </div>
                        <input value="" class="form-control" id="hardware_update_serial_number_info" name="serial_number" aria-describedby="serial_help">
                    </div>
                    <small id="serial_help" class="form-text text-muted mb-3">Örn:SN:012345</small>
                    <label for="detail">Detay</label>
                    <div class="input-group mb-3">
                        <textarea id="hardware_update_detail" rows="5" maxlength="255" class="form-control" aria-label="With textarea" name="detail" style="resize: none;"></textarea>
                    </div>
                    <div>
                        <span id="hardware_update_type"></span>
                    </div>
                    <input type="hidden" name="old_barcode_number" id="hardware_update_barcode_number">
                    <input type="hidden" name="old_serial_number" id="hardware_update_serial_number">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="hardwareDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donanım Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('hardware_delete') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Tip:</u></b> <span id="hardware_delete_type"></span></br>
                        <b><u>Model:</u></b> <span id="hardware_delete_model"></span></br>
                        <b><u>Barkod No:</u></b> <span id="hardware_delete_barcode_number_info"></span></br>
                        <b><u>Seri No:</u></b> <span id="hardware_delete_serial_number"></span></br>
                        <b><u>Detay:</u></b></br> <span id="hardware_delete_detail"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Donanımı Silmek Üzeresiniz!</u></br>
                        <b>Silme İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="barcode_number" id="hardware_delete_barcode_number">
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
