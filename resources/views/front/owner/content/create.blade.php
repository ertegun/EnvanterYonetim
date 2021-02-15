<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('user')}}">Kullanıcı</a></li>
            <li class="breadcrumb-item"><a href="{{route('owner',['id'=>$user->id])}}">Zimmet Yönetim</a></li>
            <li class="breadcrumb-item active" aria-current="page">Zimmet Ekleme (<b>{{$user->name}}</b>)</li>
        </ol>
    </nav>
    <div class="col-12 pb-3">
        <form action="{{ route('owner_create_result') }}" method="POST">
            @csrf
            <div class="row">
                @canany(['isAdmin','isIT'])
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
                        <select class="form-control software_select" name="softwares[]" multiple tabindex="-1"></select>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#softwareCreateModal" class="btn btn-sm btn-success">Yeni Yazılım</button>
                </div>
                <div class="col-12 col-lg-6 col-xl-6 ml-auto mb-3">
                    <label for="commons">Ortak Kullanım(lar)</label>
                    <div class="input-group mb-1">
                        <select class="form-control common_select" name="commons[]" multiple tabindex="-1"></select>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#commonItemCreateModal" class="btn btn-sm btn-success">Yeni Ortak Kullanım</button>
                </div>
                @endcanany
                @canany(['isAdmin','isProducer'])
                <div class="col-12 col-lg-6 col-xl-6 mr-auto mb-3">
                    <label for="materials">Malzeme(ler)</label>
                    <div class="input-group mb-1">
                        <select class="form-control material_select" name="materials[]" multiple tabindex="-1"></select>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#materialCreateModal" class="btn btn-sm btn-success">Yeni Malzeme</button>
                </div>
                <div class="col-12 col-lg-6 col-xl-6 mr-auto mb-3">
                    <label for="materials">Araç(lar)</label>
                    <div class="input-group mb-1">
                        <select class="form-control vehicle_select" name="vehicles[]" multiple tabindex="-1"></select>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#vehicleCreateModal" class="btn btn-sm btn-success">Yeni Araç</button>
                </div>
                @endcanany
                <div class="col-12 col-lg-6 col-xl-6 mr-auto mb-3">
                    <label for="materials">Zimmet Tarihi</label>
                    <div class="input-group mb-1">
                        <input type="date" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}" class="form-control" name="issue_time" required>
                    </div>
                </div>
            </div>
            <input id="user_id" type="hidden" value="{{$user->id}}" name="user_id">
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <button class="btn btn-block btn-info" type="submit">Zimmetleri Ekle</button>
            </div>
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
                        <select class="hardware_create_type_select" id="hardware_create_type_select" name="type_id" required>
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
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Ömür(Yıl)</span>
                        </div>
                        <input type="number" value="2" min="1" max="10" class="form-control" id="hardware_create_duration" name="duration" required>
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
<div class="modal fade" id="softwareCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="softwareController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Yazılım</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="softwareCreateForm" action="{{ route('software_create_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <b class="text-danger"><u id="softwareErrorMessage"></u></b>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="softwareCreateShowType()" class="btn btn-outline-secondary" type="button">Tür</button>
                        </div>
                        <select class="software_create_type_select" id="software_create_type_select" name="type_id" required>
                            <option ng-repeat="type in types" value="@{{type.id}}">@{{type.name}}</option>
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Ekle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="commonItemCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="commonController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Ekipman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="commonCreateForm" action="{{ route('common_item_create_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <b class="text-danger"><u id="commonErrorMessage"></u></b>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="commonItemCreateShowType()" class="btn btn-outline-secondary" type="button">Tür</button>
                        </div>
                        <select class="common_create_type_select" id="common_create_type_select" name="type_id" required>
                            <option ng-repeat="type in types" value="@{{type.id}}">@{{type.name}}</option>
                        </select>
                        <input type="text" id="common_create_new_type" placeholder="Yeni Tür" name="new_type" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="commonItemCreateNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Ekipman Adı</span>
                        </div>
                        <input placeholder="Ekipman Adı" class="form-control" id="common_create_name" name="name" required>
                    </div>
                    <label for="detail">Detay</label>
                    <div class="input-group mb-3">
                        <textarea id="common_create_detail" rows="5" maxlength="255" class="form-control" aria-label="With textarea" name="detail" style="resize: none;"></textarea>
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
<div class="modal fade" id="materialCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="materialController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Malzeme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="materialCreateForm" action="{{ route('material_create_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <b class="text-danger"><u id="materialErrorMessage"></u></b>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="materialItemCreateShowType()" class="btn btn-outline-secondary" type="button">Tür</button>
                        </div>
                        <select class="material_create_type_select" id="material_create_type_select" name="type_id" required>
                            <option ng-repeat="type in types" value="@{{type.id}}">@{{type.name}}</option>
                        </select>
                        <input type="text" id="material_create_new_type" placeholder="Yeni Tür" name="new_type" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="materialCreateNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <label for="detail">Detay</label>
                    <div class="input-group mb-3">
                        <textarea id="material_create_detail" rows="5" maxlength="255" class="form-control" aria-label="With textarea" name="detail" style="resize: none;"></textarea>
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
<div class="modal fade" id="vehicleCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="vehicleController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Araç</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="vehicleCreateForm" action="{{ route('vehicle_create_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <b class="text-danger"><u id="vehicleErrorMessage"></u></b>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button onclick="vehicleCreateShowModel()" class="btn btn-outline-secondary" type="button">Marka</button>
                        </div>
                        <select class="vehicle_create_model_select" id="create_model_select" name="model_id" required>
                            <option ng-repeat="model in models" value="@{{model.id}}">@{{model.name}}</option>
                        </select>
                        <input type="text" id="vehicle_create_new_model" placeholder="Yeni Marka" name="new_model" class="form-control" disabled style="display: none">
                        <div class="input-group-append">
                            <button onclick="vehicleCreateNewModel()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Araç Adı</span>
                        </div>
                        <input class="form-control" id="vehicle_create_name" name="name" required>
                    </div>
                    <label for="detail">Detay</label>
                    <div class="input-group mb-3">
                        <textarea id="vehicle_create_detail" rows="5" maxlength="255" class="form-control" aria-label="With textarea" name="detail" style="resize: none;"></textarea>
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
@if (Cookie::get('error'))
    <div class="alert alert-dismissible fade show alert-error text-center" role="alert">
        <b class="mx-auto">{{Cookie::get('error')}}</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px 7px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
