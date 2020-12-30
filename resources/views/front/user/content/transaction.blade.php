<div class="card">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('user')}}">Kullanıcı</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$user->name}} İşlem Geçmişi</li>
        </ol>
    </nav>
    <div class="col-12 mx-auto mt-3">
        <table id="userTransactionTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" data-name="{{$user->name}}" style="width: 100%;">
            <thead>
                <th>İşlem Türü</th>
                <th>İşlem Tarihi</th>
                <th class="nosort">Hakkında İşlem Yapılan</th>
                <th>İşlem Detayı</th>
                <th>İşlem Yapılan Kişi</th>
                <th>İşlemi Yapan Kişi</th>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                @if($transaction->type_id%2 == 1)
                    <tr class="table-success">
                @else
                    <tr class="table-danger">
                @endif
                        <th scope="row">
                            {{$transaction->type}}
                        </th>
                        <td data-sort='{{$transaction->created_at}}'>{{$transaction->date}}</td>
                        <td>{{$transaction->trans_info}}</td>
                        <td>{{$transaction->trans_details}}</td>
                        <td>{{$transaction->user_name}}</td>
                        <td>{{$transaction->admin_name}}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row my-3">
            <div class="col-6 col-sm-4 col-md-3 col-xl-2 mr-auto">
                <a href="{{route("user")}}" class="btn btn-sm btn-primary btn-block">Kullanıcı</a>
            </div>
        </div>
    </div>
</div>

