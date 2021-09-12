@extends('layouts.front')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-lg-6 content-left">
    <div class="content-left-wrapper">
        <a href="#" id="logo"><img src="img/tahu.png" alt="" width="49" height="49" style="object-fit: cover;"></a>
        <div id="social">
            <ul>
                <li><a href="https://instagram.com/tahungoding"><i class="icon-instagram"></i></a></li>
            </ul>
        </div>
        <!-- /social -->
        <div>
            <figure><img src="{{ Storage::url(getActiveRecruitment()->banner) }}" alt="" class="img-fluid" width="350">
            </figure>
            <h2>Open Member 2021</h2>
            <p>{{ getActiveRecruitment()->selayang_pandang }}</p>
        </div>
        <div class="copy">© 2021 TAHUNGODING</div>
    </div>
    <!-- /content-left-wrapper -->
</div>
@if(session()->has('sukses'))
<div class="col-lg-6 content-right" id="start">
    <div class="row">
        <div class="col-sm-5">
            <img src="{{ asset('img/astronot.png') }}" width="300" alt="">
        </div>
        <div class="col-sm-7">
            <p><strong>Success <i class="text-success icon-check"></i></strong><br><br>
                Data diri anda telah kami terima dan akan kami tinjau. Informasi selanjutnya terkait hasil peninjauan
                akan kami
                sampaikan melalui email terdaftar.
                <br><br>
                Terimakasih sudah berpartisipasi, semoga mendapatkan hasil terbaik.
                <br><br>
                <a href="https://instagram.com/tahungoding" class="text-secondary"><i
                        class="icon-instagram"></i>tahungoding</a>
            </p>
        </div>
    </div>

    <!-- /Wizard container -->
</div>
@else
<div class="col-lg-6 content-right" id="start">
    <div id="wizard_container">
        <div id="top-wizard">
            <div id="progressbar"></div>
        </div>
        <!-- /top-wizard -->

        <form id="wrapped" action="{{ route('store') }}" method="POST">
            @csrf
            <input id="website" name="website" type="text" value="">
            <input type="hidden" id="checkNim">
            <input type="hidden" id="checkEmail">
            <!-- Leave for security protection, read docs for details -->
            <div id="middle-wizard">
                <div class="step">
                    <h3 class="main_question"><strong>1/5</strong>Silahkan isi data pribadi anda</h3>
                    <div class="form-group">
                        <input type="text" name="nama_lengkap" class="form-control required"
                            value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap">
                    </div>

                    <div class="form-group">
                        <input type="text" name="nim" id="nim" class="form-control" onkeypress="validateNim()"
                            value="{{ old('nim') }}" placeholder="NIM">
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control required"
                            onkeypress="validateEmail()" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <div class="styled-select clearfix">
                            <select class="wide" name="kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach($class as $classes)
                                <option value="{{ $classes->id }}">{{ $classes->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="styled-select clearfix">
                            <select class="wide required" id="district-dropdown" style="color:#6c757d !important;"
                                autocomplete="off">
                                <option value="">Pilih Kecamatan</option>
                                @foreach($districts as $districts1)
                                <option value="{{ $districts1->id }}" data-name="{{ $districts1->name }}">
                                    {{ $districts1->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="kecamatan" id="kecamatanValue">
                    </div>

                    <div class="form-group">
                        <div class="styled-select clearfix">
                            <select class="wide required" name="desa" id="village-dropdown"
                                style="color: #6c757d; !important;" autocomplete="off">
                                <option value="">Pilih Desa / Keluraha</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="styled-select clearfix">
                            <select class="wide required" name="program_studi">
                                <option value="">Pilih Program Studi</option>
                                @foreach($study_program as $study_programs)
                                <option value="{{ $study_programs->id }}"
                                    {{ old('program_studi') == $study_programs->id ? "selected" : "" }}>
                                    {{ $study_programs->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="styled-select clearfix">
                            <select class="wide required" name="semester">
                                <option value="">Pilih Semester</option>
                                @foreach($semester as $semesters)
                                <option value="{{ $semesters->id }}"
                                    {{ old('semester') == $semesters->id ? "selected" : "" }}>Semester
                                    {{ $semesters->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
                <!-- /step-->
                <div class="step" data-state="divisi">
                    <h3 class="main_question"><strong>2/5</strong>Pilih divisi yang kamu inginkan</h3>
                    @foreach($division as $divisions)
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="container_radio version_2">{{ $divisions->nama }}
                                    <input type="radio" name="divisi" value="{{ Str::slug($divisions->nama) }}"
                                        data-id="{{ $divisions->id }}" onclick="getDivisiValue(this)" class="required">
                                    <input type="hidden" name="divisi_value" class="testId">
                                    <span for="divisi" class="error" style="display: none">Required</span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-light" data-toggle="modal"
                                onclick="divisionData({{$divisions}})" data-target="#divisionModal"><i
                                    class="icon-info-1"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @foreach($division as $divisions)
                <div class="branch" id="{{ Str::slug($divisions->nama) }}">
                    <div class="step" data-state="question-4">
                        <h3 class="main_question"><strong>3/5</strong>Pilih spesialisasi yang kamu inginkan</h3>
                        @foreach($divisions->specialization_divisions as $spesialisasi)
                        <div class="row justify-content">
                            <div class="col-6">
                                <div class="form-group" style="display: inline;">
                                    <label class="container_radio version_2">{{ $spesialisasi->nama }}
                                        <input type="radio" name="spesialisasi_divisi" value="{{ $spesialisasi->id }}"
                                            class="required">
                                        <span class="checkmark"></span>
                                        <span for="spesialisasi_divisi" class="error spesialisasi-divisi-error"
                                            style="display: none">Required</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal"
                                    onclick="specializationData({{$spesialisasi}})"
                                    data-target="#specializationModal"><i class="icon-info-1"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="step" id="question-4">
                    <h3 class="main_question"><strong>4/5</strong>Apa yang kamu ketahui tentang divisi yang kamu pilih?
                    </h3>
                    <div class="form-group">
                        <textarea name="pengetahuan_divisi" class="form-control required"
                            style="height:100px;"></textarea>
                    </div>
                    <h3 class="main_question">Ceritakan pengalaman kamu jika pernah menekuni divisi tersebut sebelumnya
                        ?
                    </h3>
                    <div class="form-group">
                        <textarea name="pengalaman_divisi" class="form-control" style="height:100px;"></textarea>
                    </div>
                </div>

                <div class="submit step">
                    <h3 class="main_question"><strong>5/5</strong></h3>
                    <div class="summary">
                        <ul>
                            <li><strong>1</strong>
                                <h5 style="color: #222222 !important">Apakah kamu mempunyai pengalaman dalam
                                    berorganisasi?</h5>

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
                                <span class="text-danger pt-2" id="errorElement" style="display: none;">Mohon di isi
                                    kolom ini</span>
                                <br><br>
                            </li>
                            <li><strong>2</strong>
                                <h5 style="color: #222222 !important">Apakah kamu siap jika suatu saat nanti menjadi
                                    pengurus tahungoding?</h5>
                                <div class="form-group radio_input_2">
                                    <label class="container_radio">Ya
                                        <input type="radio" name="minat_menjadi_pengurus" value="ya" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container_radio">Mungkin
                                        <input type="radio" name="minat_menjadi_pengurus" value="mungkin"
                                            class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container_radio">Tidak
                                        <input type="radio" name="minat_menjadi_pengurus" value="tidak"
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
                <button type="button" name="backward" class="backward" onclick="show()">Prev</button>
                <button type="button" name="forward" class="forward" onclick="submitValidate()">Next</button>
                <button type="submit" class="submit" id="submitButton"
                    onclick="checkIfNull();submitValidate();">Submit</button>
            </div>
            <!-- /bottom-wizard -->
        </form>
    </div>
    <!-- /Wizard container -->
</div>

<div class="modal fade" id="divisionModal" tabindex="-1" aria-labelledby="divisionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="divisionModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="divisionModalText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Specialization -->
<div class="modal fade" id="specializationModal" tabindex="-1" aria-labelledby="specializationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="specializationModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="specializationModalText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

@endif
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('#district-dropdown').on('change', function() {
            var district_id = this.value;
            var element = $(this).find('option:selected'); 
            var kecamatanValue = element.attr("data-name"); 
            $('#kecamatanValue').val(kecamatanValue); 
            $("#village-dropdown").html('');
            $.ajax({
                url:"{{url('get-villages-by-district')}}",
                type: "POST",
                data: {
                    district_id: district_id,
                    _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $.each(result.villages,function(key,value){
                        console.log(key);
                        $("#village-dropdown").append('<option value="'+value.name+'">'+value.name+'</option>');
                        $("#village-dropdown").niceSelect('destroy');
                        $("#village-dropdown").niceSelect();
                    });
                }
            });
        }); 
    });
</script>

<script>
    function show() {
        // untuk membuat input tidak hidden 
        $("#nim").css('display', 'block');
        $("#email").css('display', 'block');
    }
</script>

<script>
    function submitValidate() {
        // validate nim 
        if(!$('#nim').valid() && $('input[name=organization_1]:checked').val() && $('input[name=minat_menjadi_pengurus]:checked').val() && $('input[name=terms]:checked').val()) {
            Swal.fire({
            icon: 'info',
            title: 'Error',
            text: 'Nim yang anda masukan sudah tersedia'
            })
        }    
        // validate email
        if(!$('#email').valid() && $('input[name=organization_1]:checked').val() && $('input[name=minat_menjadi_pengurus]:checked').val() && $('input[name=terms]:checked').val()) {
            Swal.fire({
            icon: 'info',
            title: 'Error',
            text: 'Email yang anda masukan sudah tersedia'
            })
        }    
    }
    function validateNim() {
        $('#nim').valid();    
    }

    function validateEmail() {
        $('#email').valid();    
    }
    function divisionData(data) {
        $("#divisionModalText").html(data.deskripsi)
    }
    
    function specializationData(data) {
        $("#specializationModalText").html(data.deskripsi)
    }
</script>
<script>
    function getDivisiValue(element) {
            $(".testId").val($(element).attr('data-id'));
            console.log($(element).attr('data-id'));
        }
        // check if textarea is null and show validation
        function checkIfNull() {
            if(!$("#hiddenTextArea").val() && $('input[name=organization_1]:checked').val() == 'Ya') {
                $("#errorElement").css('display', 'block');
                $("#submitButton").attr("type", "button");
                $("#hiddenTextArea").val('');
            } else if ($('input[name=organization_1]:checked').val() == 'Tidak') {
                $("#errorElement").css('display', 'none');
                $("#submitButton").attr("type", "submit");
                $("#hiddenTextArea").val('Tidak');
            }

            if($("#hiddenTextArea").val() && $('input[name=organization_1]:checked').val() == 'Ya') {
                $("#errorElement").css('display', 'none');
                $("#submitButton").attr("type", "submit");
            }
        }
        // show textarea if the yes radio button is clicked (old) prevent textarea to not disappear when the website is refreshed
        if($('input[name=organization_1]:checked').val() == 'Ya') {
            $("#hiddenTextArea").css('display', 'block');
        } else if ($('input[name=organization_1]:checked').val() == 'Tidak') {
            $("#hiddenTextArea").css('display', 'none');
            $("#hiddenTextArea").val('');
        }
    // show textarea if the yes radio button is clicked (onchange)
        $('input[type=radio][name=organization_1]').change(function() {
            if (this.value == 'Ya') {
                $("#hiddenTextArea").css('display', 'block');
            }
            else if (this.value == 'Tidak') {
                $("#hiddenTextArea").css('display', 'none');
                $("#errorElement").css('display', 'none');
            }
        });
        // make the error validation from divisi disappeared 
        $('input[type=radio][name=divisi]').change(function() {
            if ($('input[name=divisi]:checked').val()) {
                $(".error").css('display', 'none');
                $("input[type=radio][name=spesialisasi_divisi]").prop("checked", false);
            }
        });
        // // check if bidang divisi(iot) is not checked
        // function errorValidation() {
        //     if( !$('input[name=spesialisasi_divisi]:checked').val())  {
        //         $(".spesialisasi-divisi-error").css('display', 'block');
        //     } 
        // }
        // // make the error validation from bidang divisi(iot) disappeared 
        // $('input[type=radio][name=spesialisasi_divisi]').change(function() {
        //     if ($('input[name=spesialisasi_divisi]:checked').val()) {
        //         $(".spesialisasi-divisi-error").css('display', 'none');
        //     }
        // });
        
</script>

@endsection