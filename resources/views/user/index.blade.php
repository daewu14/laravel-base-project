@extends('layouts.admin.master')

@section('title')
    User Management
@endsection

@section('content')
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0">@yield('title')</h5>
                            <button type="button" class="btn btn-primary" id="createNewItem">
                                Add Data
                            </button>
                        </div>
                        <p>Berikut List User, Pastikan Role User Sudah di isi dan Check Seluruh User Jika Ada Kegiatan Yang
                            Tidak di inginkan.</p>
                        <table id="zero-conf" class="display datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ajaxModel" tabindex="-1" aria-labelledby="ajaxModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content m-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajaxModelLabel">Add Or Change</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ItemForm" name="ItemForm" class="form-horizontal">
                        <input type="hidden" name="Item_id" id="Item_id">
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama Lengkap <small
                                    class="text-danger">*</small></label>
                            <input type="text" name="name" class="form-control" id="nama" placeholder="Ex Anto"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email Lengkap <small
                                    class="text-danger">*</small></label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Ex 1610xx@ittelkom-pwt.ac.id" autocomplete="off" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password Pengguna <small
                                    class="text-danger">*</small></label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="*****"
                                autocomplete="off" required>
                            <small class="text-danger">Password Minimal 8 Character</small>
                        </div>
                        <button type="button" class="btn btn-primary mt-3 mb-3 float-end" id="saveBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-tambahan')
    <link href="{{ asset('theme/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('js-tambahan')
    <script src="{{ asset('theme/plugins/DataTables/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/js/pages/datatables.js')}}"></script> --}}
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                pageLength: 5,
                lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                responsive: true,
                lengthChange: true,
                autoWidth: true,
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            //   create show modal
            $('#createNewItem').click(function() {
                $('#saveBtn').val("create-Item");
                $('#Item_id').val('');
                $('#ItemForm').trigger("reset");
                $('#modelHeading').html("Tambah Data");
                $('.tombol').html("Submit");
                $('#ajaxModel').modal('show');
            });

            //   get edit data
            $('body').on('click', '.editItem', function() {
                var Item_id = $(this).data('id');
                var url = "/user/" + Item_id + "/edit";
                // console.log(url);
                $('.tombol').html("Save Change");
                $.get(url, function(data) {
                    if (data.error) {
                        Swal.fire({
                            icon: "error",
                            title: "Mohon Maaf !",
                            text: data.error
                        });
                    } else {
                        $('#ajaxModel').modal('show');
                        $('#Item_id').val(data.id);
                        $('input[name=name]').val(data.name);
                        $('input[name=email]').val(data.email);
                        // console.log(data);
                    }
                })
            });

            //   create data
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: $('#ItemForm').serialize(),
                    url: "{{ route('user.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Selamat",
                                text: response
                                    .success
                            });
                            $('#ItemForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Mohon Maaf !",
                                text: response.error
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!"
                        });
                    }
                });
            });

            //   delete data
            $('body').on('click', '.deleteItem', function() {
                var Item_id = $(this).data("id");
                var url = $(this).data("url");
                Swal.fire({
                    title: 'Apakah Anda Yakin ?',
                    text: "Anda Akan Menghapus data Ini !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Segera'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function(response) {
                                if (response
                                    .success
                                ) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Selamat",
                                        text: response
                                            .success
                                    });
                                    $('#ItemForm')
                                        .trigger(
                                            "reset"
                                        );
                                    $('#ajaxModel')
                                        .modal(
                                            'hide'
                                        );
                                    table
                                        .draw();
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Mohon Maaf !",
                                        text: response
                                            .error
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!"
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
