@extends('layouts.back')
@section('title')
Recruitment
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-separator-1">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recruitment User</li>
                </ol>
            </nav>
            <h3>Recruitment User</h3>
        </div>
    </div>
</div>
<a href="/recruitment-user/export" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        @php
                        $jumlahSemuaRecruitmentUser = \App\Models\RecruitmentUser::all()->count();
                        @endphp
                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                            aria-controls="all" aria-selected="true">All({{$jumlahSemuaRecruitmentUser}})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                        $jumlahProses = \App\Models\RecruitmentUser::where('status', 'proses')->count();
                        @endphp
                        <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab"
                            aria-controls="proses" aria-selected="false">Proses({{$jumlahProses}})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                        $jumlahTolak = \App\Models\RecruitmentUser::where('status', 'lolos ')->count();
                        @endphp
                        <a class="nav-link" id="lolos-tab" data-toggle="tab" href="#lolos" role="tab"
                            aria-controls="lolos" aria-selected="false">Lolos({{$jumlahTolak}})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                        $jumlahTolak = \App\Models\RecruitmentUser::where('status', 'tidak_lolos ')->count();
                        @endphp
                        <a class="nav-link" id="tidak-lolos-tab" data-toggle="tab" href="#tidakLolos" role="tab"
                            aria-controls="tidakLolos" aria-selected="false">Tidak Lolos({{$jumlahTolak}})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                        $jumlahTerima = \App\Models\RecruitmentUser::where('status', 'terima')->count();
                        @endphp
                        <a class="nav-link" id="terima-tab" data-toggle="tab" href="#terima" role="tab"
                            aria-controls="terima" aria-selected="false">Terima({{$jumlahTerima}})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                        $jumlahTolak = \App\Models\RecruitmentUser::where('status', 'tolak ')->count();
                        @endphp
                        <a class="nav-link" id="tolak-tab" data-toggle="tab" href="#tolak" role="tab"
                            aria-controls="tolak" aria-selected="false">Tolak({{$jumlahTolak}})</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <table id="recruitment_all" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Terkirim</th>
                                    <th>Tahap</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Spesialisasi Divisi</th>
                                    <th>Pengetahuan Divisi</th>
                                    <th>Pengalaman Divisi</th>
                                    <th>Pengalaman Organisasi</th>
                                    <th>Minat Menjadi Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $increment_all = 1;
                                @endphp
                                @foreach($recruitment_user as $recruitments)
                                <tr>
                                    <td>{{ $increment_all++ }}</td>
                                    <td>{{ $recruitments->nama_lengkap }}</td>
                                    <td>{{ $recruitments->nim }}</td>
                                    <td>{{ $recruitments->email }}</td>
                                    <td>
                                        @if($recruitments->email_sent == '1')
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Tahap Pertama"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif
                                        @if($recruitments->email_sent == '2')
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Tahap Pertama"
                                            style="font-weight: bold; display:inline;"></i>
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Tahap Kedua"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-secondary">{{ $recruitments->stage }}</span></td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semesters->nama }}</td>
                                    <td>{{ $recruitments->divisions->nama }}</td>
                                    <td>{{ $recruitments->specialization_divisions->nama }}</td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengetahuanDivisi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>
                                        @if(!empty($recruitments->pengalaman_divisi))
                                        <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengalamanDivisi({{$recruitments}})">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        @else

                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal"
                                            onclick="pengalamanOrganisasi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>{{ $recruitments->minat_menjadi_pengurus }}</td>
                                    <td><span
                                            class="badge badge-secondary">{{ str_replace('_', ' ', $recruitments->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="form-group">

                                            @foreach($recruitment_user_cv as $cv)
                                                @if($recruitments->id == $cv->user)
                                                    <a class="btn btn-success" href={{Storage::url($cv->fileName)}}>Download CV</a>
                                                @endif
                                            @endforeach
                                            @if($recruitments->stage == '1')
                                            @if($recruitments->email_sent == '0')
                                                @if($recruitments->status == 'lolos')

                                                @else
                                                <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                    data-target="#pelolosanModal"
                                                    onclick="lolosData({{ $recruitments }})">Lolos</button>
                                                @endif
                                                @if($recruitments->status == 'tidak_lolos')

                                                @else
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#pelolosanModal"
                                                    onclick="tidakLolosData({{ $recruitments }})">Tidak Lolos</button>
                                                @endif
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->status == 'lolos' || $recruitments->status ==
                                            'tidak_lolos')
                                            @if($recruitments->email_sent == '0')
                                            @if($recruitments->status == 'lolos')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_lolos_email_no_stage_update', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="lolosEmailData(this, {{$recruitments}})">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_tidak_lolos_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="tidakLolosEmailData(this)">Kirim
                                                Email</button>
                                            @endif
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.reset_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#resetEmailModal"
                                                onclick="resetEmailData({{ $recruitments }})">Reset
                                                Email</button>
                                            @endif
                                            @endif
                                            @if($recruitments->status == 'lolos' && $recruitments->email_sent == '1')
                                            <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#stageModal" onclick="stageData({{ $recruitments }})">Tahap
                                                Kedua</button>
                                            @endif
                                            @endif
                                            @if($recruitments->stage == '2')
                                            @if($recruitments->email_sent == '1')
                                                @if($recruitments->status == 'terima')

                                                @else
                                                <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                    data-target="#penerimaanModal"
                                                    onclick="terimaData({{ $recruitments }})">Terima</button>
                                                @endif
                                                @if($recruitments->status == 'tolak')

                                                @else
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#penerimaanModal"
                                                    onclick="tolakData({{ $recruitments }})">Tolak</button>
                                                @endif
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->status == 'terima' || $recruitments->status == 'tolak')
                                            @if($recruitments->email_sent == '1')
                                            @if($recruitments->status == 'terima')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_terima_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="terimaEmailData(this, {{$recruitments}})">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_tolak_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="tolakEmailData(this)">Kirim
                                                Email</button>
                                            @endif
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.reset_email_2', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#resetEmailModal"
                                                onclick="resetEmailData2({{ $recruitments }})">Reset
                                                Email</button>
                                            @endif
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                        <br>
                        <table id="recruitment_proses" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Spesialisasi Divisi</th>
                                    <th>Pengetahuan Divisi</th>
                                    <th>Pengalaman Divisi</th>
                                    <th>Pengalaman Organisasi</th>
                                    <th>Minat Menjadi Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $increment_proses = 1;
                                @endphp
                                @foreach($recruitment_user_proses as $recruitments)
                                <tr>
                                    <td>{{ $increment_proses++ }}</td>
                                    <td>{{ $recruitments->nama_lengkap }}</td>
                                    <td>{{ $recruitments->nim }}</td>
                                    <td>{{ $recruitments->email }}</td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semesters->nama }}</td>
                                    <td>{{ $recruitments->divisions->nama }}</td>
                                    <td>{{ $recruitments->specialization_divisions->nama }}</td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengetahuanDivisi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>
                                        @if(!empty($recruitments->pengalaman_divisi))
                                        <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengalamanDivisi({{$recruitments}})">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        @else

                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal"
                                            onclick="pengalamanOrganisasi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>{{ $recruitments->minat_menjadi_pengurus }}</td>
                                    <td><span class="badge badge-secondary">{{ $recruitments->status }}</span></td>
                                    <td>
                                        <div class="form-group">
                                            @foreach($recruitment_user_cv as $cv)
                                                @if($recruitments->id == $cv->user)
                                                    <a class="btn btn-success" href={{Storage::url($cv->fileName)}}>Download CV</a>
                                                @endif
                                            @endforeach
                                            <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#pelolosanModal"
                                                onclick="lolosData({{ $recruitments }})">Lolos</button>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#pelolosanModal"
                                                onclick="tidakLolosData({{ $recruitments }})">Tidak Lolos</button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="lolos" role="tabpanel" aria-labelledby="lolos-tab">
                        <br>
                        @if(count($recruitment_user_lolos) < 1) @else
                            <div class="form-group">
                                <button class="btn btn-dark" data-url="{{ route('recruitment-users.send_all_lolos_email') }}"
                                    data-toggle="modal" data-target="#sendAllLolosEmailModal"
                                    onclick="allLolosEmailData(this)">Kirim
                                    Semua Email</button>
                            </div>
                        @endif
                        <table id="recruitment_lolos" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Terkirim</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Spesialisasi Divisi</th>
                                    <th>Pengetahuan Divisi</th>
                                    <th>Pengalaman Divisi</th>
                                    <th>Pengalaman Organisasi</th>
                                    <th>Minat Menjadi Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $increment_lolos = 1;
                                @endphp
                                @foreach($recruitment_user_lolos as $recruitments)
                                <tr>
                                    <td>{{ $increment_lolos++ }}</td>
                                    <td>{{ $recruitments->nama_lengkap }}</td>
                                    <td>{{ $recruitments->nim }}</td>
                                    <td>{{ $recruitments->email }}</td>
                                    <td>
                                        @if($recruitments->email_sent == '1')
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Email Terkirim"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semesters->nama }}</td>
                                    <td>{{ $recruitments->divisions->nama }}</td>
                                    <td>{{ $recruitments->specialization_divisions->nama }}</td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengetahuanDivisi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>
                                        @if(!empty($recruitments->pengalaman_divisi))
                                        <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengalamanDivisi({{$recruitments}})">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        @else

                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal"
                                            onclick="pengalamanOrganisasi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>{{ $recruitments->minat_menjadi_pengurus }}</td>
                                    <td><span class="badge badge-secondary">{{ $recruitments->status }}</span></td>
                                    <td>
                                        <div class="form-group">
                                            @foreach($recruitment_user_cv as $cv)
                                                @if($recruitments->id == $cv->user)
                                                    <a class="btn btn-success" href={{Storage::url($cv->fileName)}}>Download CV</a>
                                                @endif
                                            @endforeach
                                            @if($recruitments->email_sent == '0')
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#pelolosanModal"
                                                onclick="tidakLolosData({{ $recruitments }})">Tidak Lolos</button>
                                            @else
                                            <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#penerimaanModal"
                                                onclick="terimaData({{ $recruitments }})">Terima</button>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#penerimaanModal"
                                                onclick="tolakData({{ $recruitments }})">Tolak</button>
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->email_sent == '0')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_lolos_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="lolosEmailData(this)">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.reset_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#resetEmailModal"
                                                onclick="resetEmailData({{ $recruitments }})">Reset
                                                Email</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tidakLolos" role="tabpanel" aria-labelledby="proses-tab">
                        <br>
                        @if(count($recruitment_user_tidak_lolos) < 1) @else
                            <div class="form-group">
                                <button class="btn btn-dark"
                                    data-url="{{ route('recruitment-users.send_all_tidak_lolos_email') }}"
                                    data-toggle="modal" data-target="#sendAllTidakLolosEmailModal"
                                    onclick="allTidakLolosEmailData(this)">Kirim
                                    Semua Email</button>
                            </div>
                        @endif
                        <table id="recruitment_tidaklolos" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Terkirim</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Spesialisasi Divisi</th>
                                    <th>Pengetahuan Divisi</th>
                                    <th>Pengalaman Divisi</th>
                                    <th>Pengalaman Organisasi</th>
                                    <th>Minat Menjadi Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $increment_tidak_lolos = 1;
                                @endphp
                                @foreach($recruitment_user_tidak_lolos as $recruitments)
                                <tr>
                                    <td>{{ $increment_tidak_lolos++ }}</td>
                                    <td>{{ $recruitments->nama_lengkap }}</td>
                                    <td>{{ $recruitments->nim }}</td>
                                    <td>{{ $recruitments->email }}</td>
                                    <td>
                                        @if($recruitments->email_sent == '1')
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Email Terkirim"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semesters->nama }}</td>
                                    <td>{{ $recruitments->divisions->nama }}</td>
                                    <td>{{ $recruitments->specialization_divisions->nama }}</td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengetahuanDivisi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>
                                        @if(!empty($recruitments->pengalaman_divisi))
                                        <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengalamanDivisi({{$recruitments}})">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        @else

                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#showModal" onclick="pengalamanOrganisasi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>{{ $recruitments->minat_menjadi_pengurus }}</td>
                                    <td><span class="badge badge-secondary">{{ str_replace('_', ' ', $recruitments->status) }}</span></td>
                                    <td>
                                        <div class="form-group">

                                            @foreach($recruitment_user_cv as $cv)
                                                @if($recruitments->id == $cv->user)
                                                    <a class="btn btn-success" href={{Storage::url($cv->fileName)}}>Download CV</a>
                                                @endif
                                            @endforeach
                                            @if($recruitments->email_sent == '0')
                                            <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#pelolosanModal"
                                                onclick="lolosData({{ $recruitments }})">Lolos</button>
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->email_sent == '0')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_tidak_lolos_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="tidakLolosEmailData(this)">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.reset_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#resetEmailModal"
                                                onclick="resetEmailData({{ $recruitments }})">Reset
                                                Email</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="terima" role="tabpanel" aria-labelledby="terima-tab">
                        <br>
                        @if(count($recruitment_user_terima) < 1) @else
                            <div class="form-group">
                                <button class="btn btn-dark" data-url="{{ route('recruitment-users.send_all_terima_email') }}"
                                    data-toggle="modal" data-target="#sendAllTerimaEmailModal"
                                    onclick="allTerimaEmailData(this)">Kirim
                                    Semua Email</button>
                            </div>
                        @endif
                        <table id="recruitment_terima" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Terkirim</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Spesialisasi Divisi</th>
                                    <th>Pengetahuan Divisi</th>
                                    <th>Pengalaman Divisi</th>
                                    <th>Pengalaman Organisasi</th>
                                    <th>Minat Menjadi Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $increment_terima = 1;
                                @endphp
                                @foreach($recruitment_user_terima as $recruitments)
                                <tr>
                                    <td>{{ $increment_terima++ }}</td>
                                    <td>{{ $recruitments->nama_lengkap }}</td>
                                    <td>{{ $recruitments->nim }}</td>
                                    <td>{{ $recruitments->email }}</td>
                                    <td>
                                        @if($recruitments->email_sent == '2')
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Email Terkirim"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semesters->nama }}</td>
                                    <td>{{ $recruitments->divisions->nama }}</td>
                                    <td>{{ $recruitments->specialization_divisions->nama }}</td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                            onclick="pengetahuanDivisi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>
                                        @if(!empty($recruitments->pengalaman_divisi))
                                        <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                            onclick="pengalamanDivisi({{$recruitments}})">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        @else

                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                            onclick="pengalamanOrganisasi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>{{ $recruitments->minat_menjadi_pengurus }}</td>
                                    <td><span class="badge badge-secondary">{{ $recruitments->status }}</span></td>
                                    <td>
                                        <div class="form-group">

                                            @foreach($recruitment_user_cv as $cv)
                                                @if($recruitments->id == $cv->user)
                                                    <a class="btn btn-success" href={{Storage::url($cv->fileName)}}>Download CV</a>
                                                @endif
                                            @endforeach
                                            @if($recruitments->email_sent == '1')
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#penerimaanModal"
                                                onclick="tolakData({{ $recruitments }})">Tolak</button>
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->email_sent == '1')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_terima_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="terimaEmailData(this)">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.reset_email_2', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#resetEmailModal"
                                                onclick="resetEmailData2({{ $recruitments }})">Reset
                                                Email</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tolak" role="tabpanel" aria-labelledby="tolak-tab">
                        <br>
                        @if(count($recruitment_user_tolak) < 1) @else
                            <div class="form-group">
                                <button class="btn btn-dark" data-url="{{ route('recruitment-users.send_all_tolak_email') }}"
                                    data-toggle="modal" data-target="#sendAllTolakEmailModal"
                                    onclick="allTolakEmailData(this)">Kirim Semua Email</button>
                            </div>
                        @endif
                        <table id="recruitment_tolak" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Terkirim</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Spesialisasi Divisi</th>
                                    <th>Pengetahuan Divisi</th>
                                    <th>Pengalaman Divisi</th>
                                    <th>Pengalaman Organisasi</th>
                                    <th>Minat Menjadi Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $increment_tolak = 1;
                                @endphp
                                @foreach($recruitment_user_tolak as $recruitments)
                                <tr>
                                    <td>{{ $increment_tolak++ }}</td>
                                    <td>{{ $recruitments->nama_lengkap }}</td>
                                    <td>{{ $recruitments->nim }}</td>
                                    <td>{{ $recruitments->email }}</td>
                                    <td>
                                        @if($recruitments->email_sent == '2')
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Email Terkirim"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semesters->nama }}</td>
                                    <td>{{ $recruitments->divisions->nama }}</td>
                                    <td>{{ $recruitments->specialization_divisions->nama }}</td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                            onclick="pengetahuanDivisi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>
                                        @if(!empty($recruitments->pengalaman_divisi))
                                        <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                            onclick="pengalamanDivisi({{$recruitments}})">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        @else

                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                            onclick="pengalamanOrganisasi({{$recruitments}})"><i
                                                class="fas fa-info-circle"></i></button></td>
                                    <td>{{ $recruitments->minat_menjadi_pengurus }}</td>
                                    <td><span class="badge badge-secondary">{{ $recruitments->status }}</span></td>
                                    <td>
                                        <div class="form-group">
                                            @foreach($recruitment_user_cv as $cv)
                                                @if($recruitments->id == $cv->user)
                                                    <a class="btn btn-success" href={{Storage::url($cv->fileName)}}>Download CV</a>
                                                @endif
                                            @endforeach
                                            @if($recruitments->email_sent == '1')
                                            <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#penerimaanModal"
                                                onclick="terimaData({{ $recruitments }})">Terima</button>
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->email_sent == '1')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_tolak_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="tolakEmailData(this)">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.reset_email_2', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#resetEmailModal"
                                                onclick="resetEmailData2({{ $recruitments }})">Reset
                                                Email</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Penerimaan -->
<div class="modal fade" id="penerimaanModal" tabindex="-1" role="dialog" aria-labelledby="penerimaanModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="penerimaanModalTitle">Penerimaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-users.update', '') }}" method="post" id="penerimaanForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="status">
                <div class="modal-body">
                    apakah anda yakin untuk <b><span id="penerimaanModalText"></span></b> peserta ini ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="buttonStatusModalConfirm"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pelolosan -->
<div class="modal fade" id="pelolosanModal" tabindex="-1" role="dialog" aria-labelledby="lolosModallTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lolosModalTitle">Pelolosan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-users.update', '') }}" method="post" id="lolosForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="status">
                <div class="modal-body">
                    apakah anda yakin untuk <b><span id="lolosModalText"></span></b> peserta ini ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="buttonPelolosanModalConfirm"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Stage -->
<div class="modal fade" id="stageModal" tabindex="-1" role="dialog" aria-labelledby="stageModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stageModalTitle">Tahap 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-users.stage', '') }}" method="post" id="stageForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="stage">
                <div class="modal-body">
                    apakah anda yakin untuk <b>mengalihkan</b> peserta ini ke tahap kedua ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya, Alihkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Send All Lolos Email -->
<div class="modal fade" id="sendAllLolosEmailModal" tabindex="-1" role="dialog"
    aria-labelledby="sendAllLolosEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendAllLolosEmailModalTitle">Kirim Semua Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b>semua email</b> kepada peserta yang <b>lolos</b> sebagai anggota
                tahungoding?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendAllLolosEmailButton">Ya, Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Send All Tidak Lolos Email -->
<div class="modal fade" id="sendAllTidakLolosEmailModal" tabindex="-1" role="dialog"
    aria-labelledby="sendAllTidakLolosEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendAllTidakLolosEmailModalTitle">Kirim Semua Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b>semua email</b> kepada peserta yang <b>tidak lolos</b> sebagai anggota
                tahungoding?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendAllTidakLolosEmailButton">Ya, Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Send All Terima Email -->
<div class="modal fade" id="sendAllTerimaEmailModal" tabindex="-1" role="dialog"
    aria-labelledby="sendAllTerimaEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendAllTerimaEmailModalTitle">Kirim Semua Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b> semua email</b> kepada peserta yang <b>diterima</b> sebagai anggota
                tahungoding?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendAllTerimaEmailButton">Ya, Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Send All Tolak Email -->
<div class="modal fade" id="sendAllTolakEmailModal" tabindex="-1" role="dialog"
    aria-labelledby="sendAllTolakEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendAllTolakEmailModalTitle">Kirim Semua Email </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b> semua email</b> kepada peserta yang <b>ditolak</b> sebagai anggota
                tahungoding?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendAllTolakEmailButton">Ya, Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Send Email -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModallTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalTitle">Kirim Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan email <b><span id="keteranganEmail"></span></b> kepada
                peserta ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendEmailButton">Ya, Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reset Email -->
<div class="modal fade" id="resetEmailModal" tabindex="-1" role="dialog" aria-labelledby="resetEmailModallTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetEmailModalTitle">Reset Email </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-users.reset_email', '') }}" method="post" id="resetEmailForm">
                @csrf
                <input type="hidden" name="email_sent" id="email_sent">
                <input type="hidden" name="stage" id="stage">
                <div class="modal-body">
                    apakah anda yakin untuk mereset <b> email</b> ini?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya, Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Show -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <p id="showModalText"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalTitle">Hapus Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-users.destroy', '') }}" method="post" id="confirmDeleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    apakah anda yakin untuk <b>menghapus</b> peserta ini ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Ya, Hapus !</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
    $('#recruitment_all').DataTable( {
        responsive: true
    });
} );

$(document).ready(function() {
    $('#recruitment_proses').DataTable( {
        responsive: true
    });
});

$(document).ready(function() {
    $('#recruitment_lolos').DataTable( {
        responsive: true
    });
});

$(document).ready(function() {
    $('#recruitment_tidaklolos').DataTable( {
        responsive: true
    });
});

$(document).ready(function() {
    $('#recruitment_terima').DataTable({
        responsive: true
    });
});

$(document).ready(function() {
    $('#recruitment_tolak').DataTable({
        responsive: true
    });
});

$(document).ready(function(){

        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');

        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
           .columns.adjust()
           .responsive.recalc();
        });
    });

    function terimaEmailData(element, data) {
        $("#keteranganEmail").html('penerimaan');
        $("#sendEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendEmailButton').prop('disabled', true);
        });
    }

    function tolakEmailData(element) {
        $("#keteranganEmail").html('penolakan');
        $("#sendEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendEmailButton').prop('disabled', true);
        });
    }

    function lolosEmailData(element, data) {
        $("#keteranganEmail").html('lolos');
        $("#sendEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendEmailButton').prop('disabled', true);
        });
    }

    function tidakLolosEmailData(element) {
        $("#keteranganEmail").html('tidak lolos');
        $("#sendEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendEmailButton').prop('disabled', true);
        });
    }

    function allTerimaEmailData(element) {
        $("#sendAllTerimaEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendAllTerimaEmailButton').prop('disabled', true);
        });
    }

    function allTolakEmailData(element) {
        $("#sendAllTolakEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendAllTolakEmailButton').prop('disabled', true);
        });
    }

    function allLolosEmailData(element) {
        $("#sendAllLolosEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendAllLolosEmailButton').prop('disabled', true);
        });
    }

    function allTidakLolosEmailData(element) {
        $("#sendAllTidakLolosEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendAllTidakLolosEmailButton').prop('disabled', true);
        });
    }

        const resetEmailLink = $('#resetEmailForm').attr('action');
        function resetEmailData(data) {
            $('[name="email_sent"]').val('0');
            $('[name="stage"]').val('1');
            $('#resetEmailForm').attr('action',  `${resetEmailLink}/${data.id}`);
        }

        function resetEmailData2(data) {
            $('[name="email_sent"]').val('1');
            $('[name="stage"]').val('2');
            $('#resetEmailForm').attr('action',  `${resetEmailLink}/${data.id}`);
        }

        const penerimaanLink = $('#penerimaanForm').attr('action');
        function terimaData(data) {
            $('#penerimaanForm').attr('action',  `${penerimaanLink}/${data.id}`);
            $('[name="status"]').val('terima');
            $('#penerimaanModalText').text('menerima');
            $('#buttonStatusModalConfirm').text('Ya, Terima');
        }

        function tolakData(data) {
            $('#penerimaanForm').attr('action',  `${penerimaanLink}/${data.id}`);
            $('[name="status"]').val('tolak');
            $('#penerimaanModalText').text('menolak');
            $('#buttonStatusModalConfirm').text('Ya, Tolak');
        }

        const lolosLink = $('#lolosForm').attr('action');
        function lolosData(data) {
            $('#lolosForm').attr('action',  `${lolosLink}/${data.id}`);
            $('[name="status"]').val('lolos');
            $('#lolosModalText').text('meloloskan');
            $('#buttonPelolosanModalConfirm').text('Ya, Loloskan');
        }

        const deleteLink = $('#confirmDeleteForm').attr('action');
        function deleteData(data) {
            $('#confirmDeleteForm').attr('action',  `${deleteLink}/${data.id}`);
        }

        function tidakLolosData(data) {
            $('#lolosForm').attr('action',  `${lolosLink}/${data.id}`);
            $('[name="status"]').val('tidak_lolos');
            $('#lolosModalText').text('tidak meloloskan');
            $('#buttonPelolosanModalConfirm').text('Ya, Tidak Lolos');
        }

        const stageLink = $('#stageForm').attr('action');
        function stageData(data) {
            $('#stageForm').attr('action',  `${stageLink}/${data.id}`);
            $('[name="stage"]').val('2');
        }

        function pengetahuanDivisi(data) {
            $('#showModalTitle').text('Pengetahuan Divisi');
            $('#showModalText').text(data.pengetahuan_divisi);
        }

        function pengalamanDivisi(data) {
            $('#showModalTitle').text('Pengalaman Divisi');
            $('#showModalText').text(data.pengalaman_divisi);
        }

        function pengalamanOrganisasi(data) {
            $('#showModalTitle').text('Pengalaman Organisasi');
            $('#showModalText').text(data.pengalaman_organisasi);
        }
</script>
@endsection
