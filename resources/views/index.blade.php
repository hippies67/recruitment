@extends('layouts.master')
@section('content')
    @if(session()->has('sukses'))
    <div class="col-lg-6 content-right" id="start">
        <img src="{{ asset('img/astronot.png') }}" width="300" alt="">
        <p><strong>Success <i class="text-success icon-check"></i></strong><br><br>
            Data diri anda telah kami terima dan akan kami tinjau. Informasi selanjutnya terkait hasil peninjauan akan kami sampaikan melalui email terdaftar. 
            <br><br>
            Terimakasih sudah berpartisipasi, semoga mendapatkan hasil terbaik.
            <br><br>
            <a href="https://instagram.com/tahungoding" class="text-secondary"><i class="icon-instagram"></i>tahungoding</a>
        </p>
            <!-- /Wizard container -->
    </div>    
    @else
    <div class="col-lg-6 content-right" id="start">
        <div id="wizard_container">
            {{-- <div id="top-wizard">
                <div id="progressbar"></div>
            </div> --}}
            <!-- /top-wizard -->
        
            <form id="wrapped" action="{{ route('recruitment.store') }}" method="POST">
                @csrf
                <input id="website" name="website" type="text" value="">
                <!-- Leave for security protection, read docs for details -->
                <div id="middle-wizard">
                    <div class="step">
                        <h3 class="main_question"><strong>1/5</strong>Silahkan isi data pribadi anda</h3>
                        <div class="form-group">
                            <input type="text" name="nama_lengkap" class="form-control required"
                                value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <input type="text" name="kelas" class="form-control required" value="{{ old('kelas') }}"
                                placeholder="Kelas">
                        </div>

                        <div class="form-group">
                            <div class="styled-select clearfix">
                                @php
                                $semester = array("Teknik Informatika", "Sistem Informasi", "Manajemen Informatika");
                                @endphp
                                <select class="wide required" name="prodi">
                                    <option value="">Pilih Prodi</option>
                                    @for($v = 0; $v < count($semester); $v++) <option
                                        {{ old('prodi') == $v ? "selected" : "" }} value="{{ $semester[$v] }}">
                                        {{ $semester[$v] }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="styled-select clearfix">
                                @php
                                $semester = 7;
                                @endphp
                                <select class="wide required" name="semester">
                                    <option value="">Pilih Semester</option>
                                    @for($v = 1; $v <= $semester; $v++) <option
                                        {{ old('semester') == $v ? "selected" : "" }} value="Semester {{ $v }}">Semester
                                        {{ $v }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control required" value="{{ old('email') }}"
                                placeholder="Email">
                        </div>
                    </div>
                    <!-- /step-->
                    <div class="step" data-state="divisi">
                        <h3 class="main_question"><strong>2/5</strong>Pilih divisi yang kamu inginkan</h3>
                        <div class="form-group">
                            <label class="container_radio version_2">Web Development
                                <input type="radio" name="divisi" value="web_development" class="required">
                                <span for="divisi" class="error" style="display: none">Required</span>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="container_radio version_2">Internet of Things
                                <input type="radio" name="divisi" value="iot" class="required">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="branch" id="web_development">
                        <div class="step" data-state="question-4">
                            <h3 class="main_question"><strong>3/5</strong>Pilih bidang yang kamu inginkan</h3>
                            <div class="form-group">
                                <label class="container_radio version_2">Front-End
                                    <input type="radio" name="bidang_web" value="front_end" class="required">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="container_radio version_2">Back-End
                                    <input type="radio" name="bidang_web" value="back_end" class="required">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="container_radio version_2">UI/UX
                                    <input type="radio" name="bidang_web" value="ui/ux" class="required">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="branch" id="iot">
                        <div class="step" data-state="question-4">
                            <h3 class="main_question"><strong>3/5</strong>Pilih bidang yang kamu inginkan</h3>
                            <div class="form-group">
                                <label class="container_radio version_2">Product Design
                                    <input type="radio" name="bidang_iot" value="product_design" class="required">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="container_radio version_2">Programmer
                                    <input type="radio" name="bidang_iot" value="programmer" class="required">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="step" id="question-4">
                        <h3 class="main_question"><strong>4/5</strong>Apa yang kamu ketahui tentang divisi yang kamu pilih?
                        </h3>
                        <div class="form-group">
                            <textarea name="pengetahuan_divisi" class="form-control required"
                                style="height:100px;"></textarea>
                        </div>
                        <h3 class="main_question">Ceritakan pengalaman kamu jika pernah menekuni divisi tersebut sebelumnya ?
                        </h3>
                        <div class="form-group">
                            <textarea name="pengalaman_divisi" class="form-control"
                                style="height:100px;"></textarea>
                        </div>
                    </div>
                    
                    <div class="submit step">
                        <h3 class="main_question"><strong>5/5</strong></h3>
                        <div class="summary">
                            <ul>
                                <li><strong>1</strong>
                                    <h5 style="color: #222222 !important">Apakah kamu mempunyai pengalaman dalam berorganisasi?</h5>

                                    <div class="form-group radio_input_2">
                                        <label class="container_radio">Ya
                                            <input type="radio" name="organization_1" value="Ya" class="required">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio">Tidak
                                            <input type="radio" name="organization_1" value="Tidak" class="required">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <textarea name="pengalaman_organisasi" class="form-control" id="hiddenTextArea"
                                        style="height:100px;display:none;" onkeyup="checkIfNull()"></textarea>
                                        <span class="text-danger pt-2" id="errorElement" style="display: none;">Mohon di isi kolom ini</span>
                                    <br><br>
                                </li>
                                <li><strong>2</strong>
                                    <h5 style="color: #222222 !important">Apakah kamu siap jika suatu saat nanti menjadi pengurus tahungoding?</h5>
                                    <div class="form-group radio_input_2">
                                        <label class="container_radio">Ya
                                            <input type="radio" name="kesanggupan_menjadi_pengurus" value="Ya"
                                                class="required">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio">Tidak
                                            <input type="radio" name="kesanggupan_menjadi_pengurus" value="Tidak"
                                                class="required">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group terms">
                            <label class="container_check">Dengan mengisi form tersebut kamu telah bersedia menjadi bagian
                                dari tahungoding dan menaati <a href="">peraturan</a> yang berlaku, dan kamu juga telah siap
                                untuk mengikuti semua rangkaian kegiatan yang telah disiapkan oleh pengurus.
                                <input type="checkbox" name="terms" value="Yes" class="required">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                   
                    <!-- /step-->
                </div>
                <!-- /middle-wizard -->
                <div id="bottom-wizard">
                    <button type="button" name="backward" class="backward">Prev</button>
                    <button type="button" name="forward" class="forward" id="klik" onclick="checkValue()">Next</button>
                    <button type="submit" class="submit" id="submitButton" onclick="checkIfNull()">Submit</button>
                </div>
                <!-- /bottom-wizard -->
            </form>
        </div>
        <!-- /Wizard container -->
    </div>
    @endif
@endsection

@section('js')
<script>
    function checkValue() {

        if($('input[type=radio][name=divisi]').val() == 'web_development') ) {
            alert('dd');
        }
    }
    function checkIfNull() {
        if(!$("#hiddenTextArea").val() && $('input[name=organization_1]:checked').val() == 'Ya') {
            $("#errorElement").css('display', 'block');
            $("#submitButton").attr("type", "button");
        } else {
            $("#errorElement").css('display', 'none');
            $("#submitButton").attr("type", "submit");
            $("#hiddenTextArea").val('Tidak');
        }
    }

    function errorValidation() {
        if(!$('input[name=bidang_divisi]:checked').val() ) {
            alert('working');
        }
    }

    $('input[type=radio][name=divisi]').change(function() {
            if ($('input[name=divisi]:checked').val()) {
                $(".error").css('display', 'none');
            }
        });


    if($('input[name=organization_1]:checked').val() == 'Ya') {
        $("#hiddenTextArea").css('display', 'block');
    } else if ($('input[name=organization_1]:checked').val() == 'Tidak') {
        $("#hiddenTextArea").css('display', 'none');
        $("#hiddenTextArea").val('Tidak');
    }

    $('input[type=radio][name=organization_1]').change(function() {
            if (this.value == 'Ya') {
                $("#hiddenTextArea").css('display', 'block');
            }
            else if (this.value == 'Tidak') {
                $("#hiddenTextArea").css('display', 'none');
                $("#errorElement").css('display', 'none');
            }
        });

</script>
@endsection