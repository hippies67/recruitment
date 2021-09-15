@extends('layouts.back')
@section('title')
Division
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    label.error {
        color: #f1556c;
        font-size: 13px;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;
        margin-top: 5px;
        padding: 0;
    }

    input.error {
        color: #f1556c;
        border: 1px solid #f1556c;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-separator-1">
                    <li class="breadcrumb-item"><a href="{{ url('/recruitment-data') }}">Recruitment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Division</li>
                </ol>
            </nav>
            <h3>Division</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#division" role="tab"
                            aria-controls="division" aria-selected="true">Division</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#specialization_division"
                            role="tab" aria-controls="specialization_division" aria-selected="false">Specialization
                            Division</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="division" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <div class="form-group mb-4">
                            <button data-toggle="modal" data-target="#tambahModal"
                                class="btn btn-sm btn-dark">Tambah</button>
                        </div>
                        <table id="division_table" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $increment_division = 1;
                                @endphp
                                @foreach($division as $divisions)
                                <tr>
                                    <td>{{ $increment_division++ }}</td>
                                    <td>{{ $divisions->nama }}</td>
                                    <td>{{ $divisions->deskripsi }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#editModal" onclick="editData({{$divisions}})"><i
                                            class="fa fa-edit"></i></button>
                                            <button type="button" data-toggle="modal"
                                                data-target="#confirmDeleteModal" class="btn btn-danger"
                                                onclick="deleteData({{ $divisions }})"><i class="fa fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="specialization_division" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <br>
                        @if(count($division) < 1)
                        @else
                      
                        <div class="form-group mb-4">
                            <button data-toggle="modal" data-target="#tambahSpecDivModal"
                                class="btn btn-sm btn-dark">Tambah</button>
                        </div>
                        @endif
                        <table id="specialization_division_table" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Divisi</th>
                                    <th>Nama Spesialisasi</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $increment_specialization_division = 1;
                                @endphp
                                @foreach($specialization_division as $specialization_divisions)
                                <tr>
                                    <td>{{ $increment_specialization_division++ }}</td>
                                    <td>{{ $specialization_divisions->divisions->nama }}</td>
                                    <td>{{ $specialization_divisions->nama }}</td>
                                    <td>{{ $specialization_divisions->deskripsi }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#editSpecDivModal" onclick="editSpecDivData({{$specialization_divisions}})"><i
                                            class="fa fa-edit"></i></button>
                                            <button type="button" data-toggle="modal"
                                                data-target="#confirmDeleteSpecDivModal" class="btn btn-danger"
                                                onclick="deleteSpecDivData({{ $specialization_divisions }})"><i class="fa fa-trash"></i>
                                            </button>
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


<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="TambahModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahModalTitle">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('divisions.store') }}" id="tambahDivisiForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-between">
                        
                        <div class="col-sm-12">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Divisi">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('divisions.update', '') }}" id="editDivisiForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="checkDivisionName">
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <input type="text" name="edit_nama" class="form-control" placeholder="Nama Divisi">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <textarea name="edit_deskripsi" class="form-control" placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalTitle">Hapus Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('divisions.destroy', '') }}" method="post" id="confirmDeleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    apakah anda yakin untuk menghapus <b> divisi</b> ini beserta seluruh data terkait <b>(spesialisasi divisi, recruitment user)</b> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Ya, Hapus !</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Specialization Division-->
<div class="modal fade" id="tambahSpecDivModal" tabindex="-1" role="dialog" aria-labelledby="TambahSpecDivModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahSpecDivModalTitle">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('specialization-divisions.store') }}" id="tambahSpecDivForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <select name="division" class="form-control">
                                @foreach($division as $divisions)
                                <option value="{{ $divisions->id }}">
                                    {{ $divisions->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Spesialisasi">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Specialization Division -->
<div class="modal fade" id="editSpecDivModal" tabindex="-1" role="dialog" aria-labelledby="editSpecDivModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpecDivModalTitle">Edit Spesialisasi Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('specialization-divisions.update', '') }}" id="editSpecDivForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="checkSpecializationDivisionName">
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <select name="edit_divisi" id="editDivision" class="form-control">
                                @foreach($division as $divisions)
                                <option value="{{ $divisions->id }}">
                                    {{ $divisions->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="text" name="edit_nama" class="form-control" placeholder="Nama Spesialisasi">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <textarea name="edit_deskripsi" class="form-control" placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal delete Specialization Division -->
<div class="modal fade" id="confirmDeleteSpecDivModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteSpecDivModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteSpecDivModalTitle">Hapus Spesialisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('specialization-divisions.destroy', '') }}" method="post" id="confirmDeleteSpecDivForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    apakah anda yakin untuk menghapus <b> spesialisasi</b> ini ?
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

{{-- Jquery Validation --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script>
$(document).ready(function() {
    $('#division_table').DataTable({
        responsive: true
    });
});

$(document).ready(function() {
    $('#specialization_division_table').DataTable({
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

</script>

{{-- Division --}}
<script>
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#tambahDivisiForm").validate({
                rules: {
                    nama:{
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        remote: {
                                url: "{{ route('checkDivisionName') }}",
                                type: "post",
                        }
                    },
                    deskripsi:{
                        required: true,
                        minlength: 3,
                    },
                },
                messages: {
                    nama: {
                        required: "Nama Divisi harus di isi",
                        minlength: "Nama Divisi tidak boleh kurang dari 3 karakter",
                        maxlength: "Nama Divisi tidak boleh lebih dari 30 karakter",
                        remote: "Nama Divisi sudah tersedia"
                    },
                    deskripsi: {
                        required: "Deskripsi harus di isi",
                        minlength: "Deskripsi tidak boleh kurang dari 3 karakter",
                    },
                }
            });

            $("#editDivisiForm").validate({
                rules: {
                    edit_nama:{
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        remote: {
                            param: {
                                url: "{{ route('checkDivisionName') }}",
                                type: "post",
                            },
                            depends: function(element) {
                                // compare name in form to hidden field
                                return ($(element).val() !== $('#checkDivisionName').val());
                            },
                           
                        }
                    },
                },
                messages: {
                    edit_nama: {
                        required: "Nama Divisi harus di isi",
                        minlength: "Nama Divisi tidak boleh kurang dari 3 karakter",
                        maxlength: "Nama Divisi tidak boleh lebih dari 30 karakter",
                        remote: "Nama Divisi sudah tersedia"
                    },
                }
            });
        });

        const updateLink = $('#editDivisiForm').attr('action');
        function editData(data) {
            $('#editDivisiForm').attr('action',  `${updateLink}/${data.id}`);
            $('#checkDivisionName').val(data.nama);
            $('[name="edit_nama"]').val(data.nama);
            $('[name="edit_deskripsi"]').val(data.deskripsi);
        }

        const updateLink2 = $('#confirmDeleteForm').attr('action');
        function deleteData(data) {
            $('#confirmDeleteForm').attr('action',  `${updateLink}/${data.id}`);
        }  
</script>
{{-- Specialization Division --}}
<script>
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#tambahSpecDivForm").validate({
                rules: {
                    nama:{
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        remote: {
                                url: "{{ route('checkSpecializationDivisionName') }}",
                                type: "post",
                        }
                    },
                    deskripsi:{
                        required: true,
                        minlength: 3,
                    },
                },
                messages: {
                    nama: {
                        required: "Nama Spesialisasi harus di isi",
                        minlength: "Nama Spesialisasi tidak boleh kurang dari 3 karakter",
                        maxlength: "Nama Spesialisasi tidak boleh lebih dari 30 karakter",
                        remote: "Nama Spesialisasi sudah tersedia"
                    },
                    deskripsi: {
                        required: "Deskripsi harus di isi",
                        minlength: "Deskripsi tidak boleh kurang dari 3 karakter",
                    },
                }
            });

            $("#editSpecDivForm").validate({
                rules: {
                    edit_nama:{
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        remote: {
                            param: {
                                url: "{{ route('checkSpecializationDivisionName') }}",
                                type: "post",
                            },
                            depends: function(element) {
                                // compare name in form to hidden field
                                return ($(element).val() !== $('#checkSpecializationDivisionName').val());
                            },
                           
                        }
                    },
                },
                messages: {
                    edit_nama: {
                        required: "Nama Spesialisasi harus di isi",
                        minlength: "Nama Spesialisasi tidak boleh kurang dari 3 karakter",
                        maxlength: "Nama Spesialisasi tidak boleh lebih dari 30 karakter",
                        remote: "Nama Spesialisasi sudah tersedia"
                    },
                }
            });
        });

        const updateLinkSpecDiv = $('#editSpecDivForm').attr('action');
        function editSpecDivData(data) {
            $('#editSpecDivForm').attr('action',  `${updateLinkSpecDiv}/${data.id}`);
            $('#checkSpecializationDivisionName').val(data.nama);
            $('[name="edit_nama"]').val(data.nama);
            $('[name="edit_deskripsi"]').val(data.deskripsi);
            $('#editDivision').val(data.division);
        }

        const updateLinkSpecDiv2 = $('#confirmDeleteSpecDivForm').attr('action');
        function deleteSpecDivData(data) {
            $('#confirmDeleteSpecDivForm').attr('action',  `${updateLinkSpecDiv2}/${data.id}`);
        }  
</script>

@endsection