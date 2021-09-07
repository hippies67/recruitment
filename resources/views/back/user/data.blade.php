@extends('layouts.back')
@section('title')
User Manajement
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
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
                    <li class="breadcrumb-item active" aria-current="page">User Manajement</li>
                </ol>
            </nav>
            <h3>User Manajement</h3>
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
                <h5 class="header-title pb-2">Data Akun Anda</h5>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $auth = Auth::user();
                        @endphp
                        <tr>
                            <td>{{ $auth->name }}</td>
                            <td>{{ $auth->username }}</td>
                            <td>{{ $auth->email }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal"
                                    onclick="editData({{$auth}})"><i class="fa fa-edit"></i></button>
                                <button type="button" data-toggle="modal" data-target="#confirmDeleteModal"
                                    class="btn btn-danger" onclick="deleteData({{ $auth }})"><i
                                        class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <h5 class="header-title pb-2 pt-4">Data User</h5>
                <table id="user_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $users)
                        <tr>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->username }}</td>
                            <td>{{ $users->email }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal"
                                    onclick="editData({{$users}})"><i class="fa fa-edit"></i></button>
                                <button type="button" data-toggle="modal" data-target="#confirmDeleteModal"
                                    class="btn btn-danger" onclick="deleteData({{ $users }})"><i
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
                <h5 class="modal-title" id="TambahModalTitle">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('user-managements.store') }}" id="tambahUserForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="password" name="password" id="originPassword" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
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
                <h5 class="modal-title" id="editModalTitle">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('user-managements.update', '') }}" id="editUserForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="checkUsername">
                <input type="hidden" id="checkEmail">
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <input type="text" name="edit_name" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="text" name="edit_username" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="email" name="edit_email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <a class="btn btn-sm btn-info" id="passwordPage" href="{{ route('user-managements.Password', '') }}">Ubah Password <i class="fa fa-edit"></i></a>
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
                <h5 class="modal-title" id="confirmDeleteModalTitle">Hapus Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('user-managements.destroy', '') }}" method="post" id="confirmDeleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    apakah anda yakin untuk menghapus <b> akun</b> ini ?
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

{{-- Jquery Validation --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script>
    $(document).ready(function() {
            $('#user_table').DataTable();
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
            $("#tambahUserForm").validate({
                rules: {
                    name:{
                        required: true,
                        minlength: 3,
                    },
                    username:{
                        required: true,
                        minlength: 3,
                        remote: {
                                url: "{{ route('checkUsername') }}",
                                type: "post",
                        }
                    },
                    email:{
                        required: true,
                        minlength: 3,
                        remote: {
                                url: "{{ route('checkEmail') }}",
                                type: "post",
                        }
                    },
                    password : {
                        required: true,
                        minlength : 2
                    },
                    password_confirmation : {
                        required: true,
                        equalTo : "#originPassword"
                    },
                },
                messages: {
                    name: {
                        required: "Nama Lengkap harus di isi",
                        minlength: "Nama Lengkap tidak boleh kurang dari 3 karakter",
                        remote: "Nama Lengkap sudah tersedia"
                    },
                    username: {
                        required: "Username harus di isi",
                        minlength: "Username tidak boleh kurang dari 3 karakter",
                        remote: "Username sudah tersedia"
                    },
                    email: {
                        required: "Email harus di isi",
                        minlength: "Email tidak boleh kurang dari 3 karakter",
                        remote: "Email sudah tersedia"
                    },
                    password: {
                        required: "Password harus di isi",
                        minlength: "Password tidak boleh kurang dari 2 karakter"
                    },
                    password_confirmation: {
                        required: "Konfirmasi Password harus di isi",
                        equalTo: "Konfirmasi Password tidak sama"
                    },
                    
                },
                submitHandler: function(form) {
                    $("#tambahButton").prop('disabled', true);
                    form.submit();
                }
            });

            $("#editKelasForm").validate({
                rules: {
                    edit_name:{
                        required: true,
                        minlength: 3,
                    },
                    edit_username:{
                        required: true,
                        minlength: 3,
                        remote: {
                            param: {
                                url: "{{ route('checkUsername') }}",
                                type: "post",
                            },
                            depends: function(element) {
                                // compare name in form to hidden field
                                return ($(element).val() !== $('#checkUsername').val());
                            },
                           
                        }
                    },
                    edit_email:{
                        required: true,
                        minlength: 3,
                        remote: {
                            param: {
                                url: "{{ route('checkEmail') }}",
                                type: "post",
                            },
                            depends: function(element) {
                                // compare name in form to hidden field
                                return ($(element).val() !== $('#checkEmail').val());
                            },
                           
                        }
                    },
                    edit_password : {
                        required: true,
                        minlength : 2
                    },
                    edit_password_confirmation : {
                        required: true,
                        equalTo : "#originEditPassword"
                    },
                },
                messages: {
                    edit_name: {
                        required: "Nama Lengkap harus di isi",
                        minlength: "Nama Lengkap tidak boleh kurang dari 3 karakter",
                        remote: "Nama Lengkap sudah tersedia"
                    },
                    edit_username: {
                        required: "Username harus di isi",
                        minlength: "Username tidak boleh kurang dari 3 karakter",
                        remote: "Username sudah tersedia"
                    },
                    edit_email: {
                        required: "Email harus di isi",
                        minlength: "Email tidak boleh kurang dari 3 karakter",
                        remote: "Email sudah tersedia"
                    },
                    edit_password: {
                        required: "Password harus di isi",
                        minlength: "Password tidak boleh kurang dari 2 karakter"
                    },
                    edit_password_confirmation: {
                        required: "Konfirmasi Password harus di isi",
                        equalTo: "Konfirmasi Password tidak sama"
                    },
                },
                submitHandler: function(form) {
                    $("#editButton").prop('disabled', true);
                    form.submit();
                }
            });
        });

        const updateLink = $('#editUserForm').attr('action');
        const passwordLink = $('#passwordPage').attr('href');
        function editData(data) {
            $('#editUserForm').attr('action',  `${updateLink}/${data.id}`);
            $('#passwordPage').attr('href',  `${passwordLink}/${data.id}`);
            $('#checkUsername').val(data.username);
            $('#checkEmail').val(data.email);
            $('[name="edit_name"]').val(data.name);
            $('[name="edit_username"]').val(data.username);
            $('[name="edit_email"]').val(data.email);
        }

        const updateLink2 = $('#confirmDeleteForm').attr('action');
        function deleteData(data) {
            $('#confirmDeleteForm').attr('action',  `${updateLink2}/${data.id}`);
        }  
</script>
@endsection