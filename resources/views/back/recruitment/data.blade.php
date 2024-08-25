@extends('layouts.back')
@section('title')
Recruitment
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
{{-- dropify --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .dropify-wrapper {
        border: 1px solid #e2e7f1 !important;
        border-radius: .3rem !important;
        height: 100% !important;
    }

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
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-separator-1">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recruitment</li>
                </ol>
            </nav>
            <h3>Recruitment</h3>
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
                <table id="recruitment_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Selayang Pandang</th>
                            <th>Banner</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recruitment as $recruitments)
                        <tr>
                            <td>{{ $recruitments->tahun }}</td>
                            <td><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#showModal"
                                    onclick="selayangPandang({{$recruitments}}, 'Selayang Pandang')"><i
                                        class="fas fa-info-circle"></i></button>
                            </td>
                            <td><button class="btn btn-sm btn-secondary" data-toggle="modal"
                                    data-target="#bannerModal{{ $recruitments->id }}"><i
                                        class="fas fa-info-circle"></i></button>
                            </td>
                            <td>
                                @if($checkIfExists > 0)

                                @else
                                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#activeModal"
                                    onclick="activeData({{$recruitments}})"><i
                                        class="far fa-arrow-alt-circle-up"></i></button>
                                @endif
                                @if($recruitments->status == 'aktif')
                                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#activeModal"
                                    onclick="notActiveData({{$recruitments}})"><i
                                        class="far fa-arrow-alt-circle-down"></i></button>
                                @endif
                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editModal{{$recruitments->id}}"
                                    onclick="editData({{$recruitments}})"><i class="fa fa-edit"></i></button>
                                <button type="button" data-toggle="modal" data-target="#confirmDeleteModal"
                                    class="btn btn-sm btn-danger" onclick="deleteData({{ $recruitments }})"><i
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

<!-- Modal Active -->
<div class="modal fade" id="activeModal" tabindex="-1" role="dialog" aria-labelledby="activeModallTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activeModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-data.update', '') }}" method="post" id="activatingRecruitmentForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="edit_status">
                <div class="modal-body">
                    apakah anda yakin untuk <span id="statusModalText"></span> <b> recruitment</b> ini ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="buttonStatusModalConfirm">Ya, Aktifkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Show -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="TambahModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalTitle">Selayang Pandang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-between">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="showContent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Kembali</button>
            </div>
        </div>
    </div>
</div>

@foreach($recruitment as $recruitments)
<div class="modal fade" id="bannerModal{{ $recruitments->id }}" tabindex="-1" role="dialog"
    aria-labelledby="bannerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bannerModalTitle">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-between">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ Storage::url($recruitments->banner) }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Kembali</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="TambahModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahModalTitle">Tambah Recruitment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('recruitment-data.store') }}" id="tambahRecruitmentForm"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <br>
                            <input type="number" name="tahun" class="form-control" placeholder="Tahun">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <textarea name="selayang_pandang" class="form-control"
                                placeholder="Selayang Pandang"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="file" class="form-control dropify" name="banner" id="banner"
                                data-allowed-file-extensions="png jpg jpeg svg">
                            @error('banner')
                            <style>
                                .dropify-wrapper {
                                    border: 1px solid #dc3545 !important;
                                    border-radius: .3rem !important;
                                    height: 100% !important;
                                }
                            </style>
                            <div class="mt-1">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="tidak_aktif">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-4" id="tambahButton">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach($recruitment as $recruitments)
<div class="modal fade" id="editModal{{$recruitments->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Recruitment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form class="form-horizontal" action="{{ route('recruitment-data.update', $recruitments->id) }}" id="editRecruitmentForm"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="checkRecruitmentYear">
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-sm-12">
                            <br>
                            <input type="number" name="edit_tahun" class="form-control" placeholder="Tahun">
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <textarea name="edit_selayang_pandang" class="form-control"
                                placeholder="Selayang Pandang"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <input type="file" class="form-control dropify" name="edit_banner" id="banner"
                                data-allowed-file-extensions="png jpg jpeg svg" data-default-file="@if(!empty($recruitments->banner) &&
                            Storage::exists($recruitments->banner)){{ Storage::url($recruitments->banner) }}@endif">
                            @error('banner')
                            <style>
                                .dropify-wrapper {
                                    border: 1px solid #dc3545 !important;
                                    border-radius: .3rem !important;
                                    height: 100% !important;
                                }
                            </style>
                            <div class="mt-1">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-4" id="editButton">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalTitle">Hapus Recruitment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ route('recruitment-data.destroy', '') }}" method="post" id="confirmDeleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    apakah anda yakin untuk menghapus <b> recruitment</b> ini beserta seluruh data terkait <b>(recruitment user)</b> ?
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
    $('#recruitment_table').DataTable({
        responsive: true
    });
});
</script>
{{-- dropify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify();
</script>

{{-- recruitment --}}
{{-- Division --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#tambahRecruitmentForm").validate({
                rules: {
                    tahun:{
                        required: true,
                        remote: {
                                url: "{{ route('checkRecruitmentYear') }}",
                                type: "post",
                        }
                    },
                    selayang_pandang:{
                        required: true,
                    },
                    banner:{
                        required: true,
                    },
                },
                messages: {
                    tahun: {
                        required: "Tahun harus di isi",
                        remote: "Tahun sudah tersedia"
                    },
                    selayang_pandang: {
                        required: "Selayang Pandang harus di isi",
                    },
                    banner: {
                        required: "Banner harus di isi",
                    },
                },
                submitHandler: function(form) {
                    $("#tambahButton").prop('disabled', true);
                    form.submit();
                }
            });

            $("#editRecruitmentForm").validate({
                rules: {
                    edit_tahun:{
                        required: true,
                        remote: {
                            param: {
                                url: "{{ route('checkRecruitmentYear') }}",
                                type: "post",
                            },
                            depends: function(element) {
                                // compare name in form to hidden field
                                return ($(element).val() !== $('#checkRecruitmentYear').val());
                            },

                        }
                    },
                    edit_selayang_pandang:{
                        required: true,
                    }
                },
                messages: {
                    edit_tahun: {
                        required: "Tahun harus di isi",
                        remote: "Tahun sudah tersedia"
                    },
                    edit_selayang_pandang: {
                        required: "Selayang Pandang harus di isi",
                    },
                    edit_banner: {
                        required: "Banner harus di isi",
                    },
                },
                submitHandler: function(form) {
                    $("#editButton").prop('disabled', true);
                    form.submit();
                }
            });
        });

        const updateLink = $('#editRecruitmentForm').attr('action');
        function editData(data) {
            $('#editRecruitmentForm').attr('action',  `${updateLink}/${data.id}`);
            $('#checkRecruitmentYear').val(data.tahun);
            $('[name="edit_tahun"]').val(data.tahun);
            $('[name="edit_selayang_pandang"]').text(data.selayang_pandang);
            $('[name="edit_banner"]').val(data.banner);
        }

        const updateLink2 = $('#confirmDeleteForm').attr('action');
        function deleteData(data) {
            $('#confirmDeleteForm').attr('action',  `${updateLink2}/${data.id}`);
        }

        function selayangPandang(data, title) {
            $("#showContent").html('<p>'+ `${data.selayang_pandang}`+ '</p>');
        }

        const activatingLink = $('#activatingRecruitmentForm').attr('action');
        function activeData(data) {
            $('#activatingRecruitmentForm').attr('action',  `${activatingLink}/${data.id}`);
            $('[name="edit_status"]').val('aktif');
            $('#activeModalTitle').text('Aktivasi Recruitment');
            $('#statusModalText').text('mengaktifkan');
            $('#buttonStatusModalConfirm').text('Ya, Aktifkan');
        }

        function notActiveData(data) {
            $('#activatingRecruitmentForm').attr('action',  `${activatingLink}/${data.id}`);
            $('[name="edit_status"]').val('tidak_aktif');
            $('#activeModalTitle').text('Aktivasi Recruitment');
            $('#statusModalText').text('menonaktifkan');
            $('#buttonStatusModalConfirm').text('Ya, Nonaktifkan');
        }

</script>
@endsection
