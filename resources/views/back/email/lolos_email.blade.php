@component('mail::message')
<p style="color: #222">Hi {{ $recruitment_user->nama_lengkap }}</p>

<p style="color: #222;"><b>Selamat</b> kamu dinyatakan <b style="color:green">LOLOS</b> pada tahap pertama proses seleksi Open Recruitment TAHUNGODING {{ $recruitment_user->recruitments->tahun }}.</p>

<p style="color: #222">Tahap selanjutnya adalah, kamu wajib menghadiri Video Conference (Meeting Online) pada hari <b>Jum'at 24 September 2021 Pukul 14:00 - Selesai</b></p>

@component('mail::button', ['url' => 'https://meet.google.com/oqm-kxmr-bzz'])
Join Meeting
@endcomponent
<br>
<p style="color: #222">Terimakasih sudah berpartisipasi dalam Open Recruitment TAHUNGODING {{ $recruitment_user->recruitments->tahun }}, Kami tunggu KARYA MU !</p>
<br>
<p style="color: #222">Regards,</p>
<p style="color: #222">TAHUNGODING</p>
@endcomponent
