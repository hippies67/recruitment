@component('mail::message')
<p style="color: #222">Hi {{ $recruitment_user->nama_lengkap }}</p>

<p style="color: #222;"><b>Maaf</b> kamu dinyatakan <b style="color:green">DITOLAK</b> bergabung bersama kami di TAHUNGODING </p>

<p style="color: #222">dikarenakan kuota member sudah penuh.</p>

<br>
<p style="color: #222">Terimakasih kamu sudah berpartisipasi dalam Open Member TAHUNGODING {{ $recruitment_user->recruitments->tahun }}</p>
<br>
<p style="color: #222">Regards,</p>
<p style="color: #222">Pengurus</p>
@endcomponent
