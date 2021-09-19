@component('mail::message')
<p style="color: #222">Hi {{ $recruitment_user->nama_lengkap }}</p>

<p style="color: #222;"><b>Mohon</b> maaf untuk saat ini kamu <b style="color:red">BELUM</b> bisa menjadi bagian dari TAHUNGODING karena satu dan dua hal. </p>

<p style="color: #222">Kamu bisa mencobanya <b>Kembali</b> di Open Recruitment TAHUNGODING selanjutnya.</p>

<br>
<p style="color: #222">Terima kasih sudah berpartisipasi dalam Open Recruitment TAHUNGODING {{ $recruitment_user->recruitments->tahun }} tetap semangat dan teruslah berkarya dimanapun kamu berada !</p>
<br>
<p style="color: #222">Regards,</p>
<p style="color: #222">TAHUNGODING</p>
@endcomponent
