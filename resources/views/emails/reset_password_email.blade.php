@component('mail::message')
Sayın <b>{{$data['admin_name']}};</b><br><br>
   <div style="text-align: center">Şifre sıfırama talebiniz alınmıştır. Aşağıdaki butona tıklayarak yeni şifrenizi oluşturabilirsiniz.</div>
   <br><br>
   <h4><b><u>Kullanıcı Adınız: </u></b>{{$data['admin_user_name']}}</h4>
@component('mail::button', ['url' => route('reset_password',['token'=>$data['token']])])
Şifremi Sıfırla
@endcomponent

İyi Günler<br>
@endcomponent
