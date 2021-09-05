@component('mail::message')
<p style="color: #222">Hi {{ $recruitment_user->nama_lengkap }}</p>

<p style="color: #222;"><b>Selamat</b> kamu dinyatakan <b style="color:green">DITERIMA</b> bergabung bersama kami di TAHUNGODING .</p>

<p style="color: #222">Tahap selanjutnya adalah, kamu wajib mengikuti Video Conference (Meeting Online) besok hari <b>Jum'at 16 Oktober 2020 Pukul 14:00 - Selesai</b></p>

@component('mail::button', ['url' => 'https://meet.google.com/soo-iszx-wru'])
Join Meeting
@endcomponent
<br>
<p style="color: #222">Terimakasih kamu sudah berpartisipasi dalam Open Member TAHUNGODING {{ $recruitment_user->recruitments->tahun }}, Kami tunggu KARYA MU !</p>
<br>
<p style="color: #222">Regards,</p>
<p style="color: #222">Pengurus</p>
@endcomponent
