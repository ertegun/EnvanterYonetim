<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('vehicle')}}">Araç</a></li>
            <li class="breadcrumb-item active" aria-current="page">Araç Markaları</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        <table id="vehicleModelTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <th>Marka</th>
                <th class="text-center">Kullanılan</th>
                <th class="text-center">Kullanılabilir</th>
                <th class="text-center">Toplam</th>
                <th class="text-center nosort">İşlemler</th>
            </thead>
            <tbody>
                @foreach($vehicle_models as $model)
                    <tr>
                        <td>{{$model->name}}</td>
                        <td class="text-center">{{$model->using_item}}</td>
                        <td class="text-center">{{$model->useable_item}}</td>
                        <td class="text-center">{{$model->total_item}}</td>
                        <td class="text-center">
                            <span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Markayı Düzenle">
                                <a onclick="vehicleModelUpdate('{{$model->id}}','{{$model->name}}')" data-toggle="modal" data-target="#vehicleModelUpdateModal">
                                    <i class="fas fa-edit table-icon text-primary"></i>
                                </a>
                            </span>
                            @if($model->total_item == 0)
                                <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Markayı Siler!">
                                    <a onclick="vehicleModelDelete('{{$model->id}}','{{$model->name}}')" data-toggle="modal" data-target="#vehicleModelDeleteModal">
                                        <i class="fas fa-trash-alt table-icon text-danger"></i>
                                    </a>
                                </span>
                            @else
                                <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Marka</br> Üzerindeki Tüm Araçları</br>Araç Sayfasından Siliniz!">
                                    <a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">
                                        <i class="fas fa-trash-alt table-icon-disabled"></i>
                                    </a>
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row my-3">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mb-2">
                <a href="{{ route('vehicle') }}" class="btn btn-sm btn-primary btn-block">Araç</a>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <button type="button" data-toggle="modal" data-target="#vehicleModelCreateModal" class="btn btn-sm btn-success btn-block">Yeni Marka</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="vehicleModelDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Araç Markası Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vehicle_model_delete') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Marka Adı:</u></b> <span id="vehicle_model_delete_name"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Araç Markasını Silmek Üzeresiniz!</u></br>
                        <b>Silme İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="id" id="vehicle_model_delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Sil</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="vehicleModelUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Araç Modeli Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vehicle_model_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Model Adı</span>
                        </div>
                        <input class="form-control" id="vehicle_model_update_name" name="name" required>
                    </div>
                    <input type="hidden" name="old_name" id="vehicle_model_update_old_name">
                    <input type="hidden" name="id" id="vehicle_model_update_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="vehicleModelCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Araç Markası</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vehicle_model_create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Marka Adı</span>
                        </div>
                        <input class="form-control" placeholder="Marka Adı" name="name" required>
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
