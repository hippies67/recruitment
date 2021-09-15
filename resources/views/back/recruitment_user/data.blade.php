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
                                    <td>{{ $recruitments->email }} @if($recruitments->email_sent)
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Terkirim"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif</td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semester }}</td>
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
                                            @if($recruitments->status == 'terima')

                                            @else
                                            <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#acceptanceModal"
                                                onclick="acceptData({{ $recruitments }})">Terima</button>
                                            @endif
                                            @if($recruitments->status == 'tolak')

                                            @else
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#acceptanceModal"
                                                onclick="rejectData({{ $recruitments }})">Tolak</button>
                                            @endif
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal"
                                                onclick="deleteData({{ $recruitments }})">Hapus</button>
                                            @if($recruitments->status == 'terima' || $recruitments->status == 'tolak')
                                            @if($recruitments->email_sent == '0')
                                            @if($recruitments->status == 'terima')
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_accepted_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="acceptedEmailData(this, {{$recruitments}})">Kirim
                                                Email</button>
                                            @else
                                            <button class="btn btn-sm btn-info"
                                                data-url="{{ route('recruitment-users.send_rejected_email', $recruitments->id) }}"
                                                data-toggle="modal" data-target="#emailModal"
                                                onclick="rejectedEmailData(this)">Kirim
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
                                    <td>{{ $recruitments->email }} @if($recruitments->email_sent)
                                        <i class="far fa-check-square text-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Terkirim"
                                            style="font-weight: bold; display:inline;"></i>
                                        @endif</td>
                                    <td>{{ $recruitments->alamat }}</td>
                                    <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                    <td>{{ $recruitments->study_programs->nama }}</td>
                                    <td>{{ $recruitments->semester }}</td>
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
                                            <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#acceptanceModal"
                                                onclick="acceptData({{ $recruitments }})">Terima</button>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#acceptanceModal"
                                                onclick="rejectData({{ $recruitments }})">Tolak</button>
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
                    <div class="tab-pane fade" id="terima" role="tabpanel" aria-labelledby="terima-tab">
                        <br>
                        @if(count($recruitment_user_terima) < 1) @else <div class="form-group">
                            <button class="btn btn-dark"
                                data-url="{{ route('recruitment-users.send_all_accepted_email') }}" data-toggle="modal"
                                data-target="#sendAllAcceptedEmailModal" onclick="allAcceptedEmailData(this)">Kirim
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
                                <td>{{ $recruitments->email }} @if($recruitments->email_sent)
                                    <i class="far fa-check-square text-success" data-toggle="tooltip"
                                        data-placement="top" data-original-title="Terkirim"
                                        style="font-weight: bold; display:inline;"></i>
                                    @endif</td>
                                <td>{{ $recruitments->alamat }}</td>
                                <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                                <td>{{ $recruitments->study_programs->nama }}</td>
                                <td>{{ $recruitments->semester }}</td>
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
                                <td><span class="badge badge-secondary">{{ $recruitments->status }}</span></td>
                                <td>
                                    <div class="form-group">
                                        @if($recruitments->email_sent == '0')
                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#acceptanceModal"
                                            onclick="rejectData({{ $recruitments }})">Tolak</button>
                                        @endif
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#confirmDeleteModal"
                                            onclick="deleteData({{ $recruitments }})">Hapus</button>
                                        @if($recruitments->email_sent == '0')
                                        <button class="btn btn-sm btn-info"
                                            data-url="{{ route('recruitment-users.send_accepted_email', $recruitments->id) }}"
                                            data-toggle="modal" data-target="#emailModal"
                                            onclick="acceptedEmailData(this)">Kirim
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
                <div class="tab-pane fade" id="tolak" role="tabpanel" aria-labelledby="tolak-tab">
                    <br>
                    @if(count($recruitment_user_tolak) < 1) @else <div class="form-group">
                        <button class="btn btn-dark" data-url="{{ route('recruitment-users.send_all_rejected_email') }}"
                            data-toggle="modal" data-target="#sendAllRejectedEmailModal"
                            onclick="allRejectedEmailData(this)">Kirim Semua Email</button>
                </div>
                @endif
                <table id="recruitment_tolak" class="table table-striped table-bordered" style="width: 100%">
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
                        $increment_tolak = 1;
                        @endphp
                        @foreach($recruitment_user_tolak as $recruitments)
                        <tr>
                            <td>{{ $increment_tolak++ }}</td>
                            <td>{{ $recruitments->nama_lengkap }}</td>
                            <td>{{ $recruitments->nim }}</td>
                            <td>{{ $recruitments->email }} @if($recruitments->email_sent)
                                <i class="far fa-check-square text-success" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Terkirim" style="font-weight: bold; display:inline;"></i>
                                @endif</td>
                            <td>{{ $recruitments->alamat }}</td>
                            <td>@if($recruitments->kelas){{ $recruitments->classes->nama }}@endif</td>
                            <td>{{ $recruitments->study_programs->nama }}</td>
                            <td>{{ $recruitments->semester }}</td>
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
                                    @if($recruitments->email_sent == '0')
                                    <button class="btn btn-sm btn-dark" data-toggle="modal"
                                        data-target="#acceptanceModal"
                                        onclick="acceptData({{ $recruitments }})">Terima</button>
                                    @endif
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#confirmDeleteModal"
                                        onclick="deleteData({{ $recruitments }})">Hapus</button>
                                    @if($recruitments->email_sent == '0')
                                    <button class="btn btn-sm btn-info"
                                        data-url="{{ route('recruitment-users.send_rejected_email', $recruitments->id) }}"
                                        data-toggle="modal" data-target="#emailModal"
                                        onclick="rejectedEmailData(this)">Kirim
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
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal Acceptance -->
<div class="modal fade" id="acceptanceModal" tabindex="-1" role="dialog" aria-labelledby="acceptanceModallTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptanceModalTitle">Penerimaan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-users.update', '') }}" method="post" id="acceptanceForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="status">
                <div class="modal-body">
                    apakah anda yakin untuk <span id="acceptanceModalText"></span> <b> peserta</b> ini ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="buttonStatusModalConfirm"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Send All Accepted Email -->
<div class="modal fade" id="sendAllAcceptedEmailModal" tabindex="-1" role="dialog"
    aria-labelledby="sendAllAcceptedEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendAllAcceptedEmailModalTitle">Kirim Semua Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b> semua email</b> kepada peserta yang diterima sebagai anggota
                tahungoding?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendAllAcceptedEmailButton">Ya, Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Send All Rejected Email -->
<div class="modal fade" id="sendAllRejectedEmailModal" tabindex="-1" role="dialog"
    aria-labelledby="sendAllRejectedEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendAllRejectedEmailModalTitle">Kirim Semua Email </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b> semua email</b> kepada peserta yang ditolak sebagai anggota
                tahungoding?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendAllRejectedEmailButton">Ya, Kirim</button>
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
                <h5 class="modal-title" id="emailModalTitle">Kirim Email <span class="badge badge-secondary ml-1"
                        id="statusEmailAccepted"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                apakah anda yakin untuk mengirimkan <b> email</b> kepada peserta ini?
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
                    apakah anda yakin untuk menghapus <b> peserta</b> ini ?
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
    function acceptedEmailData(element, data) {
        $("#statusEmailAccepted").html('Diterima');
        $("#sendEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendEmailButton').prop('disabled', true);
        });
    }  

    function rejectedEmailData(element) {
        $("#statusEmailAccepted").html('Ditolak');
        $("#sendEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendEmailButton').prop('disabled', true);
        });
    }  

    function allAcceptedEmailData(element) {
        $("#sendAllAcceptedEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendAllAcceptedEmailButton').prop('disabled', true);
        });
    } 

    function allRejectedEmailData(element) {
        $("#sendAllRejectedEmailButton").click(function() {
            var url = element.dataset.url;
            window.location.href = `${url}`;
            $('#sendAllRejectedEmailButton').prop('disabled', true);
        });
    }  
        
        const resetEmailLink = $('#resetEmailForm').attr('action');
        function resetEmailData(data) {
            $('#resetEmailForm').attr('action',  `${resetEmailLink}/${data.id}`);
        }  

        const acceptanceLink = $('#acceptanceForm').attr('action');
        function acceptData(data) {
            $('#acceptanceForm').attr('action',  `${acceptanceLink}/${data.id}`);
            $('[name="status"]').val('terima');
            $('#acceptanceModalText').text('menerima');
            $('#buttonStatusModalConfirm').text('Ya, Terima');
        }  

        const deleteLink = $('#confirmDeleteForm').attr('action');
        function deleteData(data) {
            $('#confirmDeleteForm').attr('action',  `${deleteLink}/${data.id}`);
        }  

        function rejectData(data) {
            $('#acceptanceForm').attr('action',  `${acceptanceLink}/${data.id}`);
            $('[name="status"]').val('tolak');
            $('#acceptanceModalText').text('menolak');
            $('#buttonStatusModalConfirm').text('Ya, Tolak');
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