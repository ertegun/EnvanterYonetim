<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('owner',['id'=>$user->id])}}">Zimmet Yönetim</a></li>
            <li class="breadcrumb-item active" aria-current="page">Zimmet Ekleme(<b>{{$user->name}}</b>)</li>
        </ol>
    </nav>
    <div class="col-12">
        <form action="{{ route('owner_create_result') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-6 ml-auto mb-3">
                    <label for="hardwares">Donanım(lar)</label>
                    <div class="input-group mb-1">
                        <select class="form-control hardware_select" name="hardwares[]" multiple tabindex="-1"></select>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#hardwareCreateModal" class="btn btn-sm btn-success">Yeni Donanım</button>
                </div>
                <div class="col-12 col-lg-6 col-xl-6 mr-auto mb-3">
                    <label for="softwares">Yazılım(lar)</label>
                    <div class="input-group mb-1">
                        <select class="form-control hardware_select" name="softwares[]" multiple tabindex="-1"></select>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#softwareCreateModal" class="btn btn-sm btn-success">Yeni Yazılım</button>
                </div>
            </div>
            <input type="hidden" value="{{$user->id}}" name="user_id">
            <button class="btn btn-sm btn-warning" type="submit">YOLLA</button>
        </form>
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
            <form id="hardwareCreateForm" action="{{ route('hardware_create_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <b class="text-danger"><u id="hardwareErrorMessage"></u></b>
                    </div>
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
