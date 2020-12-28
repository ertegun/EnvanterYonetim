<div class="col-12 mx-auto mt-3">
    <div class="alert alert-info text-center mx-auto" style="width: 65%; font-size: 20px" id='report_title' data-name='Tip'>
        <b>Tip Yönetim</b>
    </div>
    <table id="table" class="table table-striped table-bordered dt-responsive nowrap" style="text-align: center;width: 100%;">
        <thead>
            <tr>
                <th class="nosort">Ön Ek Kodu</th>
                <th>Tip Adı</th>
                <th>Toplam Ekipman</th>
                <th>Kullanılan Ekipman</th>
                <th class="nosort">İşlemler</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($types as $write)
            <tr>
                <th scope="row">{{$write->prefix}}</th>
                <td>{{$write->name}}</td>
                <td>{{$write->total_items}}</td>
                <td>{{$write->use_items}}</td>
                <td>
                    <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Tipi Düzenle">
                        <a href="{{ route('type_update', ['id'=>$write->id]) }}" class="ml-1 mr-1 text-decoration-none">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-brush-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.117 8.117 0 0 1-3.078.132 3.658 3.658 0 0 1-.563-.135 1.382 1.382 0 0 1-.465-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.393-.197.625-.453.867-.826.094-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.2-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.175-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04z"/>
                            </svg>
                        </a>
                    </span>
                    @if($write->total_items==0)
                        <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Tipi Siler">
                            <a href="{{ route('type_delete', ['id'=>$write->id]) }}" class="btn btn-sm btn-danger">
                                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                </svg>
                            </a>
                        </span>
                    @else
                        <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Öncelikle geçerli tip üzerindeki tüm ekipmanları kaldırınız!">
                            <a href="#" class="btn btn-sm btn-secondary disabled"  role="button" aria-disabled="true" style="pointer-events: none;">
                                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                </svg>
                            </a>
                        </span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <div class="row my-3">
            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
                <a href="{{ route('type_create') }}" class="btn btn-success btn-block">Yeni Tip</a>
            </div>
            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('hardware') }}" class="btn btn-primary btn-block">Geri Dön</a>
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

