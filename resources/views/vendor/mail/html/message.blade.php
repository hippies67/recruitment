@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
<p style="line-height: 2px;">Jl. Angrek no. 19</p>
<p>STMIK SUMEDANG</p>
<a href="https://tahungoding.com/" style="text-decoration: none; color:#000000;font-family: 'Roboto', sans-serif;"><b><i>tahungoding.com</i></b></a>
@endcomponent
@endslot
@endcomponent
