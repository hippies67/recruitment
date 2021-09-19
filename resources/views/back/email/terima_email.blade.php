@component('mail::message')
<p style="color: #222">Hi {{ $recruitment_user->nama_lengkap }}</p>

<p style="color: #222;"><b>Selamat</b> kamu <b style="color:green">DITERIMA</b> bergabung bersama kami di TAHUNGODING.</p>

<p style="color: #222">Terimakasih sudah berpartisipasi dalam Open Recruitment TAHUNGODING {{ $recruitment_user->recruitments->tahun }}, Kami tunggu KARYA MU !</p>
<br>
<p style="color: #222">Regards,</p>
<p style="color: #222">TAHUNGODING</p>
@endcomponent
