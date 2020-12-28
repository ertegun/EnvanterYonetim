<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>{{$user->name}} Zimmet Fişi</title>
</head>
<body>
    <div class="row" style="width: 100%">
        <div class="col-12 mx-auto">
        <h3 class="my-3" style="text-align: center">Zimmet Fişi</h3>
        <div class='my-3 mx-auto' style="width: 85%">
        <div style="display: flex;justify-content: space-between;">
            <p class="text-left"><u><b>TARİH:</b></u> {{date_create(now())->format('d/m/Y')}}</p>
            <p class="text-right"><u><b>SIRA NO:</b></u>.....  </p>
        </div>
        <p class="text-left" style="font-size:large;text-decoration:underline;"><b>Çalışan Ad Soyad:</b> {{$user->name}}</p>
        </table>
        <table class="table table-sm table-bordered text-left">
            <thead>
                <th>Sıra</th>
                <th>Seri No</th>
                <th>Kategori</th>
                <th>Detay</th>
                <th>Veriliş Tarihi</th>
                <th>İade Tarihi</th>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <th>{{$item->sn}}</th>
                    <td>{{$item->type}}</td>
                    <td>{{$item->detail}}</td>
                    <td>{{date_create($item->created_at)->format('d/m/Y')}}</td>
                    <td>..../..../20..</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-center mx-auto py-3" style="width: 75%">Yukarıda sıra ve sicil numarası, adı, özellikleri, nereye veya kime verildiği yazılı olan demirbaş, makine ve cihaz teslim edilmiştir. Kullanıcı kendi kusuru sonucunda doğacak zararları tazmin etmeyi kabul eder.</p>

            <table class="table table-bordered">
                <thead>
                    <th>Taşınır Kayıt ve Kontrol Yetkilisinin<br/>
                        <br/>
                        Ad Soyadı:<br/>
                        Ünvan:<br/>
                        <br/>
                        İmzası: ..................................<br/>
                    </th>
                    <th>Teslim Alanın<br/>
                        <br/>
                        Ad Soyadı<br/>
                        Ünvan:<br/>
                        <br/>
                        İmzası: ..................................<br/>
                    </th>
                </thead>
            </table>
            <p class="text-left">Yukarıda sicil numarası belirtilen taşınır eksiksiz olarak teslim alınarak zimmetten düşülmüştür.</p>
            </br>
            <div style="display: flex;justify-content: space-between;">
                <p class="text-left">Taşınır Kayıt ve Kontrol Yetkilisi</p>
                <p class="text-rigth">..../..../20...</p>
            </div>
        </br>
        </br>
        </br>
        <p class="text-left"><b>GRUP ARGE ENERJİ VE KONTROL SİSTEMLERİ  SAN. VE. TİC. LTD. ŞTİ.</b></p>
        </div>
    </div></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script></body>
</html>
