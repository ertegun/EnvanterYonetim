<div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5 mt-5 mx-auto">
    <div class="alert alert-warning mx-auto text-center" role="alert">
        <form action="{{ route('owner_delete_result') }}" method="POST">
            @csrf
            <div><b><u>{{$user->name}}</u></b> Kullanıcısı Üzerindeki
            <b><u>{{$delete->type}}</u></b> Tipindeki
            <b><u>Seri No'su {{$delete->sn}}({{$delete->bn}})</u></b> Olan Ekipmanı Silmek Üzeresiniz! </div>
            <div class="my-2"><b>Silme İşlemi Geri Döndürülemez!</b></div>
            <div class="row my-3">
                <div class="col-5 ml-auto">
                    <button class="btn btn-danger btn-block" type="submit">Sil</button>
                </div>
                <div class="col-5 mr-auto">
                    <a href="{{ route('owner', ['id'=>$user->id]) }}" class="btn btn-primary btn-block">Geri Dön</a>
                </div>
            </div>
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="bn" value="{{$delete->bn}}">
        </form>
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
