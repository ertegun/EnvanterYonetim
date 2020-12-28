<div class="col-12 col-md-10 col-lg-8 col-xl-7 mx-auto">
    <div class="alert alert-warning text-center mx-auto mt-3" style="width: 65%; font-size: 20px">
        <b>{{$user->name}}</b> Üzerinde İşlem Gerçekleştiriyorsunuz
    </div>
    <form action="{{ route('owner_create_software_result') }}" method="POST">
        @csrf
        <div class="input-group mt-3 mb-2 mx-auto">
            <div class="input-group-prepend">
                <label class="input-group-text" for="select">Yazılım</label>
            </div>
            <select class="custom-select" name="soft_id" required>
                    <option value="" disabled selected hidden>Seçiniz...</option>
                @foreach ($software as $write)
                    @if($write->type!="Süresiz")
                        <option value="{{$write->id}}">{{$write->name}} - Türü: {{$write->type}} - Bitiş Tarihi: {{date_create($write->finish_time)->format('d/m/Y')}}</option>
                    @else
                        <option value="{{$write->id}}">{{$write->name}} - Türü: {{$write->type}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="row my-3">
            <div class="col-5 col-sm-4 col-lg-3 col-md-4 col-xl-3 ml-auto">
                <button class="btn btn-success btn-block" type="submit">Ekle</button>
            </div>
            <div class="col-5 col-sm-4 col-lg-3 col-md-4 col-xl-3">
                <a href="{{ route('owner', ['id'=>$user->id]) }}" class="btn btn-primary btn-block">Geri Dön</a>
            </div>
        </div>
        <input type="hidden" value="{{$user->id}}" name="user_id">
    </form>
</div>
@if (Cookie::get('error'))
    <div class="alert alert-dismissible fade show alert-error text-center" role="alert">
        <b class="mx-auto">{{Cookie::get('error')}}</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px 7px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
