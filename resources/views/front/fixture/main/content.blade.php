

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
                            <button onclick="hardwareUpdateShowModel()" class="btn btn-outline-secondary" type="button">Marka</button>
                        </div>
                        <select class="hardware_update_model_select" id="update_model_select" name="model_id" required>
                            <option ng-repeat="model in models" value="@{{model.id}}">@{{model.name}}</option>
                        </select>
                        <input type="text" id="hardware_update_new_model" placeholder="Yeni Marka" name="new_model" class="form-control" disabled style="display: none">
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
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Ömür(Yıl)</span>
                        </div>
                        <input type="number" min="1" max="10" class="form-control" id="hardware_update_duration" name="duration" required>
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
                        <b><u>Marka:</u></b> <span id="hardware_delete_model"></span></br>
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
