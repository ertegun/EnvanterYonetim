<div class="col-12 col-sm-10 col-md-9 col-lg-7 col-xl-6 mt-3 mx-auto">
    <div class="alert alert-primary mt-3">
        <div class="text-center"><b>Tip Düzenleme</b></div>
        <form action="{{ route('type_update_result') }}" method="POST">
            @csrf
            <label for="pre">Tip Ön Eki</label>
            <div class="input-group my-2">
                <input id="pre" onkeyup="upper(event)" value="{{$select->prefix}}" type="text" class="form-control" placeholder="Örn:B,L" name="type_prefix" required>
            </div>
            <label for="tName">Tip Adı</label>
            <div class="input-group mb-2">
                <input id="tName" value="{{$select->name}}" type="text" class="form-control" placeholder="Örn:Bilgisayar,Laptop" name="type_name" required>
                <input type="hidden" name="old_type_prefix" value="{{$select->prefix}}">
                <input type="hidden" name="old_type_name" value="{{$select->name}}">
                <input type="hidden" name="total_item" value="{{$select->total_item}}">
                <input type="hidden" name="type_id" value="{{$select->id}}">
            </div>
            <div class="row my-3">
                <div class="col-5 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-auto">
                    <button class="btn btn-success btn-block" type="submit">Güncelle</button>
                </div>
                <div class="col-5 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a href="{{ route('type') }}" class="btn btn-primary btn-block">Geri Dön</a>
                </div>
            </div>
                @if($select->total_item)
                    <div class="alert alert-warning text-center mx-auto my-2" role="alert" style="width: 70%;">
                        Değişiklik Durumunda <u><b>{{$select->name}}</b></u>
                        Tipindeki <u><b>{{$select->total_item}}</b></u> Adet Ekipman Üzerinde Değişiklik Yapılacaktır!
                    </div>
                @endif
        </form></div>
</div>
<script>
    function upper(evt){
        evt.target.value = evt.target.value.toUpperCase();
    }
</script>
@if (Cookie::get('error'))
    <div class="alert alert-dismissible fade show alert-error text-center" role="alert">
        <b class="mx-auto">{{Cookie::get('error')}}</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px 7px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif



