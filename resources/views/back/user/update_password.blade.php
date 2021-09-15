@extends('layouts.back')
@section('title')
Ubah Password
@endsection

@section('css')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-separator-1">
                    <li class="breadcrumb-item"><a href="{{ url('/recruitment-data') }}">Recruitment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
                </ol>
            </nav>
            <h3>Ubah Password</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user-managements.updatePassword', $user->id) }}" method="post">
                    @csrf
                
                    <!-- start row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <p class="sub-header">
                                    Di halaman ini anda dapat mengubah password dari akun yang anda pakai.
                                </p>
                
                                <div class="form-group">
                                    <label for="passwordBaru">Password Baru<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password_baru" parsley-trigger="change"
                                            placeholder="Masukkan Password Baru"
                                            class="form-control @error('password_baru') is-invalid @enderror" id="password_baru"
                                            value="{{ old('password_baru') }}">
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-secondary fas fa-eye @error('password_baru') btn-danger @enderror toggle-password-baru"
                                                type="button"></button>
                                        </div>
                                    </div>
                
                                    @error('password_baru')
                                    <div class="mt-1">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                
                                <div class="form-group">
                                    <label for="konfirmasiPasswordBaru">Konfirmasi Password Baru<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="konfirmasi_password_baru" parsley-trigger="change"
                                            placeholder="Masukkan Konfirmasi Password Baru"
                                            class="form-control @error('konfirmasi_password_baru') is-invalid @enderror"
                                            id="konfirmasi_password_baru" value="{{ old('konfirmasi_password_baru') }}">
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-secondary fas fa-eye @error('konfirmasi_password_baru') btn-danger @enderror toggle-konfirmasi-password-baru"
                                                type="button"></button>
                                        </div>
                                    </div>
                
                                    @error('konfirmasi_password_baru')
                                    <div class="mt-1">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group text-left mt-4">
                                    <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                        Ubah
                                    </button>
                                    <a href="{{ route('user-managements.index') }}" class="btn btn-light waves-effect">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
 <!-- Toggle Show/Hide Password -->
 <script>
    $(".toggle-password-lama").click(function() {
        $(this).toggleClass("far fa-eye-slash");
        var passwordLama = document.getElementById("password_lama");

        if (passwordLama.type === "password") {
            passwordLama.type = "text";
        } else {
            passwordLama.type = "password";
        }

       
    });
    $(".toggle-password-baru").click(function() {
        $(this).toggleClass("far fa-eye-slash");
        var password = document.getElementById("password_baru");

        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    });
    
    $(".toggle-konfirmasi-password-baru").click(function() {
        $(this).toggleClass("far fa-eye-slash");
        var konfirmasiPassword = document.getElementById("konfirmasi_password_baru");

        if (konfirmasiPassword.type === "password") {
            konfirmasiPassword.type = "text";
        } else {
            konfirmasiPassword.type = "password";
        }
    });

</script>
@endsection