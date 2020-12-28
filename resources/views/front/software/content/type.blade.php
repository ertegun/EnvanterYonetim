<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('software')}}">Yazılım</a></li>
            <li class="breadcrumb-item active" aria-current="page">Yazılım Türleri</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        <table id="softwareTypeTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <th>Tür</th>
                <th class="text-center">Kullanılan</th>
                <th class="text-center">Kullanılabilir</th>
                <th class="text-center">Toplam</th>
                <th class="text-center nosort">İşlemler</th>
            </thead>
            <tbody>
                @foreach($software_types as $type)
                    <tr>
                        <td>{{$type->name}}</td>
                        <td class="text-center">{{$type->using_item}}</td>
                        <td class="text-center">{{$type->useable_item}}</td>
                        <td class="text-center">{{$type->total_item}}</td>
                        <td class="text-center">
                            <span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Türü Düzenle">
                                <a onclick="softwareTypeUpdate('{{$type->id}}','{{$type->name}}')" data-toggle="modal" data-target="#softwareTypeUpdateModal">
                                    <i class="fas fa-edit table-icon text-primary"></i>
                                </a>
                            </span>
                            @if($type->total_item == 0)
                                <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Türü Siler!">
                                    <a onclick="softwareTypeDelete('{{$type->id}}','{{$type->name}}')" data-toggle="modal" data-target="#softwareTypeDeleteModal">
                                        <i class="fas fa-trash-alt table-icon text-danger"></i>
                                    </a>
                                </span>
                            @else
                                <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Tür</br> Üzerindeki Tüm Yazılımları</br>Yazılım Sayfasından Siliniz!">
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
                <a href="{{ route('software') }}" class="btn btn-sm btn-primary btn-block">Yazılım</a>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <button type="button" data-toggle="modal" data-target="#softwareTypeCreateModal" class="btn btn-sm btn-success btn-block">Yeni Tür</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareTypeDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donanım Türü Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_type_delete') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Tür Adı:</u></b> <span id="software_type_delete_name"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Yazılım Türünü Silmek Üzeresiniz!</u></br>
                        <b>Silme İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="id" id="software_type_delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Sil</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareTypeUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yazılım Türü Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_type_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tür Adı</span>
                        </div>
                        <input class="form-control" id="software_type_update_name" name="name" required>
                    </div>
                    <input type="hidden" name="old_name" id="software_type_update_old_name">
                    <input type="hidden" name="id" id="software_type_update_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="softwareTypeCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Yazılım Türü</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('software_type_create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tür Adı</span>
                        </div>
                        <input class="form-control" placeholder="Tür Adı" name="name" required>
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
