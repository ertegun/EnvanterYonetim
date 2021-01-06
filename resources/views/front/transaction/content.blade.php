<div class="card mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">İşlem Geçmişi</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto my-3">
        <table id="table" class="table table-sm small table-striped table-bordered dt-responsive nowrap" style="text-align: center;width: 100%;">
            <thead>
                <th>İşlem Türü</th>
                <th>İşlem Tarihi</th>
                <th>Hakkında İşlem Yapılan</th>
                <th>İşlem Detayı</th>
                <th>İşlem Yapılan Kişi</th>
                <th>İşlemi Yapan Kişi</th>
            </thead>
        </table>
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

