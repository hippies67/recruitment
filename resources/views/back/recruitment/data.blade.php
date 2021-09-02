@extends('layouts.back')
@section('title')
Recruitment
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-separator-1">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recruitment Data</li>
                </ol>
            </nav>
            <h3>Recruitment Data</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                            aria-controls="all" aria-selected="true">All()</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab"
                            aria-controls="proses" aria-selected="false">Proses()</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="terima-tab" data-toggle="tab" href="#terima" role="tab"
                            aria-controls="terima" aria-selected="false">Terima()</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tolak-tab" data-toggle="tab" href="#tolak" role="tab"
                            aria-controls="tolak" aria-selected="false">Tolak()</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <table id="recruitment_all" class="table table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Divisi</th>
                                    <th>Etc</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recruitment as $recruitments)
                                <tr>
                                   <td>{{ $recruitments->nama_lengkap }}</td>
                                   <td>{{ $recruitments->kelas }}</td>
                                   <td>{{ $recruitments->prodi }}</td>
                                   <td>{{ $recruitments->semester }}</td>
                                   <td>{{ $recruitments->divisi }}</td>
                                   <td>{{ $recruitments->spesialisasi_divisi }}</td>
                                   <td>{{ $recruitments->pengetahuan_divisi }}</td>
                                   <td>{{ $recruitments->pengalaman_divisi }}</td>
                                   <td>{{ $recruitments->pengalaman_organisasi }}</td>
                                   <td>{{ $recruitments->kesanggupan_menjadi_pengurus }}</td>
                                   <td>
                                       <button class="btn btn-sm btn-warning">Edit</button>
                                       <form action="" method="post">
                                           <button class="btn btn-sm btn-danger">Hapus</button>
                                       </form>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                        <br>
                        <table id="recruitment_proses" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="terima" role="tabpanel" aria-labelledby="terima-tab">
                        <br>
                        <table id="recruitment_terima" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tolak" role="tabpanel" aria-labelledby="tolak-tab">
                        <br>
                        <table id="recruitment_tolak" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#recruitment_all').DataTable();
});

$(document).ready(function() {
    $('#recruitment_proses').DataTable();
});

$(document).ready(function() {
    $('#recruitment_terima').DataTable();
});

$(document).ready(function() {
    $('#recruitment_tolak').DataTable();
});
</script>
@endsection