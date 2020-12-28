<div class="col-12 mx-auto mt-3">
    <div class="alert alert-info text-center mx-auto" style="width: 65%; font-size: 20px" id='report_title' data-name='İşlem Geçmişi'>
        <b>İşlem Geçmişi</b>
    </div>
    <table id="table" class="table table-striped table-bordered dt-responsive nowrap" style="text-align: center;width: 100%;">
        <thead>
            <tr>
                <th>İşlem Tipi</th>
                <th>İşlem Tarihi</th>
                <th class="nosort">Ekipman/Yazılım</th>
                <th>İşlemi Yapan</th>
                <th>İşlem Yapılan</th>
            </tr>
        </thead>
    </table>
    <div class="row my-3">
        <div class="col-5 col-sm-3 col-md-4 col-xl-3 ml-auto">
            <a href="{{route("user")}}" class="btn btn-primary btn-block">Geri Dön</a>
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

