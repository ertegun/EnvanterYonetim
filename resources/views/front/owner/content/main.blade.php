<div id='userName' data-name='{{$user->name}}' class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('user')}}">Kullanıcı</a></li>
            <li class="breadcrumb-item active" aria-current="page"><b>{{$user->name}}</b>&nbsp;Zimmet Yönetim</li>
        </ol>
    </nav>
    <div class="col-12">
        <div class="card my-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-danger">
                    <li class="breadcrumb-item">
                        <a class="text-white" data-toggle="collapse" href="#hardwareCollapse" onclick="createHardwareTable()" role="button" aria-expanded="false" aria-controls="hardwareCollapse"><i class="fas fa-hdd"></i> Donanımlar</a>
                    </li>
                </ol>
            </nav>
            <div class="col-12 pb-3">
                <div id='hardwareCollapse' class="collapse card" style="border: none">
                    <table id="hardwareTable" class="table table-sm table-striped table-bordered table-hover dt-responsive nowrap" style="width: 100%"></table>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-info">
                    <li class="breadcrumb-item">
                        <a class="text-white" data-toggle="collapse" href="#softwareCollapse" onclick="createSoftwareTable()" role="button" aria-expanded="false" aria-controls="softwareCollapse"><i class="fas fa-compact-disc"></i> Yazılımlar</a>
                    </li>
                </ol>
            </nav>
            <div class="col-12 pb-3">
                <div id='softwareCollapse' class="collapse card" style="border: none">
                    <table id="softwareTable" class="table table-sm table-striped table-bordered table-hover dt-responsive nowrap" style="width: 100%"></table>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-purple">
                    <li class="breadcrumb-item">
                        <a class="text-white" data-toggle="collapse" href="#commonCollapse" onclick="createCommonTable()" role="button" aria-expanded="false" aria-controls="commonCollapse"><i class="fas fa-handshake"></i> Ortak Kullanılan Ekipmanlar</a>
                    </li>
                </ol>
            </nav>
            <div class="col-12 pb-3">
                <div id='commonCollapse' class="collapse card" style="border: none">
                    <table id="commonTable" class="table table-sm table-striped table-bordered table-hover dt-responsive nowrap" style="width: 100%"></table>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-dark">
                    <li class="breadcrumb-item">
                        <a class="text-white" data-toggle="collapse" href="#materialCollapse" onclick="createMaterialTable()" role="button" aria-expanded="false" aria-controls="materialCollapse"><i class="fas fa-tools"></i> Malzemeler (Son 1 Aylık)</a>
                    </li>
                </ol>
            </nav>
            <div class="col-12 pb-3">
                <div id='materialCollapse' class="collapse card" style="border: none">
                    <table id="materialTable" class="table table-sm table-striped table-bordered table-hover dt-responsive nowrap" style="width: 100%"></table>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 mr-auto">
                <a href="{{ route('user') }}" class="btn btn-sm btn-primary btn-block">Kullanıcı</a>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <a href="{{ route('owner_pdf', ['id'=>$user->id]) }}" class="btn btn-sm btn-danger btn-block ">Zimmet Fişi</a>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 ">
                <a href="{{ route('owner_create', ['id'=>$user->id]) }}" class="btn btn-sm btn-success btn-block">Zimmet Ekle</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hardwareDropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donanım İade İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('hardware_drop') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Tip:</u></b> <span id="hardware_drop_type"></span></br>
                        <b><u>Model:</u></b> <span id="hardware_drop_model"></span></br>
                        <b><u>Barkod No:</u></b> <span id="hardware_drop_barcode_number"></span></br>
                        <b><u>Seri No:</u></b> <span id="hardware_drop_serial_number"></span></br>
                        <b><u>Zimmet Tarihi:</u></b> <span id="hardware_drop_issue_time"></span></br>
                        <b><u>Detay:</u></b></br> <span id="hardware_drop_detail"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Donanımı İade Almak Üzeresiniz!</u></br>
                        <b>İade İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="hardware_id" id="hardware_drop_hardware_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">İade Al</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareDropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yazılım İade İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_drop') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Yazılım Adı:</u></b> <span id="software_drop_name"></span></br>
                        <b><u>Tip:</u></b> <span id="software_drop_type"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Yazılımı İade Almak Üzeresiniz!</u></br>
                        <b>İade İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="software_id" id="software_drop_software_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">İade Al</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="commonDropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ortak Kullanımdan Kaldırma İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('common_drop') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Ekipman Adı:</u></b> <span id="common_drop_name"></span></br>
                        <b><u>Türü:</u></b> <span id="common_drop_type"></span></br>
                        <b><u>Detay:</u></b></br> <span id="common_drop_detail"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Kullanıcıyı Ortak Kullanımdan Kaldırmak Üzeresiniz!</u></br>
                        <b>Bu İşlem Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="common_item_id" id="common_drop_common_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Kullanımdan Kaldır</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="materialDropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Malzeme İade İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('material_drop') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Tip:</u></b> <span id="material_drop_type"></span></br>
                        <b><u>Detay:</u></b></br> <span id="material_drop_detail"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Malzemeyi İade Almak Üzeresiniz!</u></br>
                        <b>İade İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="material_id" id="material_drop_material_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">İade Al</button>
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
