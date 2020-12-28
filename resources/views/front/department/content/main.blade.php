<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('user')}}">Kullanıcı</a></li>
            <li class="breadcrumb-item active" aria-current="page">Departman</li>
        </ol>
    </nav>
    <div class="col-12 mt-4 mx-auto">
        <table id="departmentTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="text-align: center;width: 100%;">
            <thead>
                <th>Departman</th>
                <th>Kullanıcı Sayısı</th>
                <th>Donanım</th>
                <th>Yazılım</th>
                <th>Ortak Kullanım</th>
                <th>Malzeme</th>
                <th>İşlemler</th>
            </thead>
            <tbody>
            @foreach ($departments as $department)
                <tr>
                    <th scope="row">{{$department->name}}</th>
                    <td>{{$department->user_count}}</td>
                    <td>{{$department->hardware_count}}</td>
                    <td>{{$department->software_count}}</td>
                    <td>{{$department->common_count}}</td>
                    <td>{{$department->material_count}}</td>
                    <td>
                        <span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Departmanı Düzenle">
                            <a onclick="departmentUpdate('{{$department->id}}','{{$department->name}}')" data-toggle="modal" data-target="#departmentUpdateModal">
                                <i class="fas fa-edit table-icon text-primary"></i>
                            </a>
                        </span>
                        @if($department->user_count == 0)
                            <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Departmanı Siler!">
                                <a onclick="departmentDelete('{{$department->id}}','{{$department->name}}')" data-toggle="modal" data-target="#departmentDeleteModal">
                                    <i class="fas fa-trash-alt table-icon text-danger"></i>
                                </a>
                            </span>
                        @else
                            <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Departman</br> Üzerindeki Tüm Kullanıcıları</br>Kullanıcı Sayfasından Siliniz!">
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
                <a href="{{ route('user') }}" class="btn btn-sm btn-primary btn-block">Kullanıcı</a>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <button type="button" data-toggle="modal" data-target="#departmentCreateModal" class="btn btn-sm btn-success btn-block">Yeni Departman</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="departmentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Departman Silme İşlemi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('department_delete') }}" method="POST">
                @csrf
                <div class="modal-body px-5">
                    <div>
                        <b><u>Departman:</u></b> <span id="department_delete_name"></span></br>
                    </div>
                    <div class="mt-3 my-2 text-center">
                        <u>Departmanı Silmek Üzeresiniz!</u></br>
                        <b>Silme İşlemi Geri Döndürülemez!</b>
                    </div>
                    <input type="hidden" name="id" id="department_delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Sil</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="departmentUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Departman Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('department_update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Departman</span>
                        </div>
                        <input class="form-control" id="department_update_name" name="name" required>
                    </div>
                    <input type="hidden" name="old_name" id="department_update_old_name">
                    <input type="hidden" name="id" id="department_update_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Güncelle</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="departmentCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Departman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('department_create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Departman</span>
                        </div>
                        <input class="form-control" placeholder="Departman Adı" name="name" required>
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

