<div class="col-10 col-sm-10 col-md-9 col-lg-7 col-xl-5 mt-3 mx-auto">
    <div class="alert alert-warning mx-auto text-center" role="alert" >
        <form action="{{ route('type_delete_result') }}" method="POST">
            @csrf
            <div class="mt-2"><b><u>{{$type->name}}</u></b> Tipini Silmek Üzeresiniz</div>
            <div class="mt-2"><b>Silme İşlemi Geri Döndürülemez!</b></div>
            <div class="row my-3">
                <div class="col-5 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-auto">
                    <button class="btn btn-danger btn-block" type="submit">Sil</button>
                </div>
                <div class="col-5 col-sm-4 col-md-4 col-lg-4 col-xl-4 mr-auto">
                    <a href="{{ route('type') }}" class="btn btn-primary btn-block">Geri Dön</a>
                </div>
            </div>
            <input type="hidden" name="type_id" value="{{$type->id}}">
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
