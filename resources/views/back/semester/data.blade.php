@extends('layouts.back')
@section('title')
Semester
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
                    <li class="breadcrumb-item active" aria-current="page">Semester</li>
                </ol>
            </nav>
            <h3>Semester</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-4">
                    <button data-toggle="modal" data-target="#tambahModal" class="btn btn-sm btn-dark">Tambah</button>
                </div>
                <table id="semester_table" class="table table-striped table-bordered"  style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $increments = 1 ;
                        @endphp
                        @foreach($semester as $semesters)
                        <tr>
                            <td>{{ $increments++ }}</td>
                            <td>{{ $semesters->nama }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal"
                                    onclick="editData({{$semesters}})"><i class="fa fa-edit"></i></button>
                                <button type="button" data-toggle="modal" data-target="#confirmDeleteModal"
                                    class="btn btn-danger" onclick="deleteData({{ $semesters }})"><i
                                        class="fa fa-trash"></i>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="TambahModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahModalTitle">Tambah Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('semesters.store') }}" id="tambahSemesterForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <input type="number" name="nama" class="form-control" placeholder="Nama Semester">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="tambahButton">Tambah</button>
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
                <h5 class="modal-title" id="editModalTitle">Edit Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('semesters.update', '') }}" id="editSemesterForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="checkSemesterName">
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <input type="number" name="edit_nama" class="form-control" placeholder="Nama Semester">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editButton">Ubah</button>
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
                <h5 class="modal-title" id="confirmDeleteModalTitle">Hapus Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('semesters.destroy', '') }}" method="post" id="confirmDeleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    apakah anda yakin untuk menghapus <b> semester</b> ini beserta seluruh data terkait <b>(recruitment user)</b> ?
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
        $('#semester_table').DataTable({
            responsive: true
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
            $("#tambahSemesterForm").validate({
                rules: {
                    nama:{
                        required: true,
                        number: true,
                        remote: {
                                url: "{{ route('checkSemesterName') }}",
                                type: "post",
                        }
                    },
                },
                messages: {
                    nama: {
                        required: "Semester harus di isi",
                        number: "Semester harus berupa bilangan",
                        remote: "Semester sudah tersedia"
                    },
                },
                submitHandler: function(form) {
                    $("#tambahButton").prop('disabled', true);
                    form.submit();
                }
            });

            $("#editSemesterForm").validate({
                rules: {
                    edit_nama:{
                        required: true,
                        number: true,
                        remote: {
                            param: {
                                url: "{{ route('checkSemesterName') }}",
                                type: "post",
                            },
                            depends: function(element) {
                                // compare name in form to hidden field
                                return ($(element).val() !== $('#checkSemesterName').val());
                            },

                        }
                    },
                },
                messages: {
                    edit_nama: {
                        required: "Semester harus di isi",
                        number: "Semester harus berupa bilangan",
                        remote: "Semester sudah tersedia"
                    },
                },
                submitHandler: function(form) {
                    $("#editButton").prop('disabled', true);
                    form.submit();
                }
            });
        });

        const updateLink = $('#editSemesterForm').attr('action');
        function editData(data) {
            $('#editSemesterForm').attr('action',  `${updateLink}/${data.id}`);
            $('#checkSemesterName').val(data.nama);
            $('[name="edit_nama"]').val(data.nama);
        }

        const updateLink2 = $('#confirmDeleteForm').attr('action');
        function deleteData(data) {
            $('#confirmDeleteForm').attr('action',  `${updateLink}/${data.id}`);
        }
</script>
@endsection
