<div class="col-12 col-md-10 col-lg-8 col-xl-7 mx-auto">
    <div class="alert alert-primary mt-3">
        <div class="text-center"><b>Tip Ekleme</b></div>
        <form action="{{ route('type_create_result') }}" method="POST">
            @csrf
            <label for="pre">Tip Ön Eki</label>
            <div class="input-group mb-2">
                <input id="pre" onkeyup="upper(event)" value="{{old('type_prefix')}}" type="text" class="form-control" placeholder="Örn:B,L" name="type_prefix" required >
            </div>
            <label for="tName">Tip Adı</label>
            <div class="input-group mb-2">
                <input id="tName" value="{{old('type_name')}}" type="text" class="form-control" placeholder="Örn:Bilgisayar,Laptop" name="type_name" required>
            </div>
            <div class="row my-3">
                <div class="col-5 col-sm-5 col-md-4 col-lg-4 col-xl-4 ml-auto">
                    <button class="btn btn-success btn-block" type="submit">Ekle</button>
                </div>
                <div class="col-5 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <a href="{{ route('type') }}" class="btn btn-primary btn-block">Geri Dön</a>
                </div>
            </div>
        </form>
    </div>
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
