@extends('layouts.admin.master')

@section('title')
    Borzo Integration
@endsection

@section('content')
    <div class="main-wrapper">
        @if ($notification = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Informasi !</strong> {{ $notification }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($notification = Session::get('galat'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Informasi !</strong> {{ $notification }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-align-center">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                        <div class="d-flex-justify-content-between">
                            <div>Status API</div>
                            <div id="status"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Borzo API Integration Development Version</p>
                        <a href="" class="btn btn-outline-primary d-blok"><i class="fa fa-external-link-alt"></i> Doc
                            API</a>
                    </div>
                </div>

                <div class="card text-center">
                    <div class="card-header">
                        Harga Pengiriman
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-0 harga" style="font-size: 30px;">Rp. -</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Kalkulasi Biaya
                    </div>
                    <div class="card-body">
                        <form id="ItemForm" name="ItemForm" class="">
                            <div class="form-group">
                                <p class="fw-bold mb-0">Pilih Kota Pengirim</p>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-map-marker"></i></span>
                                    <select class="form-select set-origin" required></select>
                                    <input type="text" hidden readonly name="pengirim">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="fw-bold mb-0">Pilih Kota penerima</p>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-map-marker"></i></span>
                                    <select class="form-select set-destination" required></select>
                                    <input type="text" hidden readonly name="penerima">
                                </div>
                            </div>
                            <button type="button" id="cek" class="btn btn-outline-primary col-12"><i
                                    class="fa fa-external-link-alt"></i> Submit</button>
                        </form>

                        <form id="OrderForm" name="OrderForm" class="d-none">
                            <div class="form-group mb-3">
                                <h6>Apaa yang ada Kirim ? <small class="text-danger">( E.g Document, Kue, Elektronika dll
                                        )</small></h6>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="isi"><i class="fas fa-weight"></i></span>
                                    <input type="text" class="form-control" name="isi" placeholder="E.g Document"
                                        aria-label="10" aria-describedby="isi">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <h6>Berat Paket <small class="text-danger">( Satuan KiloGram )</small></h6>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="berat"><i class="fas fa-weight"></i></span>
                                    <input type="number" class="form-control" name="berat" placeholder="10"
                                        aria-label="10" aria-describedby="berat">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <h6>Alamat Pengirim</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="no_pengirim"><i
                                                    class="fas fa-phone"></i></span>
                                            <input type="number" value="628" class="form-control" name="no_pengirim"
                                                placeholder="628xxx" aria-label="628xxx" aria-describedby="no_pengirim">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="nama_pengirim"><i
                                                    class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" name="nama_pengirim"
                                                placeholder="E.g Ojan" aria-label="628xxx" aria-describedby="nama_pengirim">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <textarea class="form-control" name="alamat_pengirim" aria-label="With textarea"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <h6>Alamat Penerima</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="no_penerima"><i
                                                    class="fas fa-phone"></i></span>
                                            <input type="number" class="form-control" name="no_penerima"
                                                placeholder="628xxx" value="628" aria-label="628xxx" aria-describedby="no_penerima">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="nama_penerima"><i
                                                    class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" name="nama_penerima"
                                                placeholder="E.g Lancelot" aria-label="628xxx"
                                                aria-describedby="nama_penerima">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <textarea class="form-control" name="alamat_penerima" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <button type="button" id="order" class="btn btn-outline-primary col-12"><i
                                    class="fas fa-shopping-cart"></i> Create Order</button>
                        </form>

                        <div class="success text-center d-none">
                            <img src="https://cdn.dribbble.com/users/2185205/screenshots/7886140/media/90211520c82920dcaf6aea7604aeb029.gif"
                                alt="" class="img-fluid">
                            <h5 class="fw-bold">Thank You</h5>
                            <p>Orderan Kamu Sudah Masuk Kepada Kami, Mohon ditunggu..</p>
                            <button type="button" id="reload" class="btn btn-outline-danger me-3"><i
                                    class="fas fa-redo"></i> Cek Ongkir</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-success shadow-sm me-3"><i class="fas fa-file"></i> Lihat Invoice</button>
                            <button type="button" id="neworder" class="btn btn-outline-primary"><i
                                    class="fas fa-shopping-cart"></i> New Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- invoice -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title invoice" id="exampleModalLabel">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- pengirim start --}}
                    <div class="d-flex">
                        <p class="fw-bold me-3">Nama Pengirim : </p>
                        <p id="nama_pengirim">-</p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-bold me-3">Nomor HP Pengirim : </p>
                        <p id="no_pengirim">-</p>
                    </div>
                    <p class="fw-bold me-3">Alamat Pengirim</p>
                    <p id="alamat_pengirim">-</p>
                    {{-- pengirim end --}}
                    <hr>
                    {{-- penerima start --}}
                    <div class="d-flex">
                        <p class="fw-bold me-3">Nama Penerima : </p>
                        <p id="nama_penerima">-</p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-bold me-3">Nomor HP Penerima : </p>
                        <p id="no_penerima">-</p>
                    </div>
                    <p class="fw-bold me-3">Alamat Penerima</p>
                    <p id="alamat_penerima">-</p>
                    {{-- penerima end --}}
                    <hr>

                    {{-- Price --}}
                    <p class="fw-bold me-3">Harga Pengiriman</p>
                    <h5 class="card-title mb-0 total" style="font-size: 30px;">Rp. -</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-tambahan')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.4/dist/select2-bootstrap4.min.css">
@endsection

@section('js-tambahan')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(".set-origin").select2({
            cacheDataSource: [],
            minimumInputLength: 3,
            theme: 'bootstrap4',
            placeholder: "Kecamatan Asal",
            ajax: {
                url: "https://kiriminaja.com/public-address",
                type: "get",
                dataType: 'json',
                quietMillis: 50,
                data: function(params) {
                    return {
                        search: params.term,
                        // coverage: true,
                        decrypt: false
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        }).on('keyup change', function() {
            var pengirim = $('.set-origin option:selected').html();
            $('input[name=pengirim]').val(pengirim);
        });
        $(".set-destination").select2({
            cacheDataSource: [],
            minimumInputLength: 3,
            theme: 'bootstrap4',
            placeholder: "Kecamatan penerima",
            ajax: {
                url: "https://kiriminaja.com/public-address",
                type: "get",
                dataType: 'json',
                quietMillis: 50,
                data: function(params) {
                    return {
                        search: params.term,
                        decrypt: false
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        }).on('keyup change', function() {
            var penerima = $('.set-destination option:selected').html();
            $('input[name=penerima]').val(penerima);
        });
    </script>
    <script type="text/javascript">
        getStatus();
        setInterval(getStatus, 3000);

        function getStatus() {
            $.get("{{ route('borzo') }}", function(data) {
                console.log(data);
                if (data == 1) {
                    $("#status").html('<span class="badge bg-success">Api Terhubung !</span>');
                } else {
                    $("#status").html('<span class="badge bg-danger">Api Terputus !</span>');
                }
            });
        }

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#cek').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#ItemForm').serialize(),
                    url: "{{ route('cektarif') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 300) {
                            console.log(response);
                            Swal.fire({
                                icon: "error",
                                title: "Mohon Maaf !",
                                text: "Invalid Parameter, Try Again"
                            });
                        } else {
                            let timerInterval
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu',
                                html: 'Sedang Kalkulasi Harga Terbaik Untuk Anda',
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector(
                                        'b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $('#ItemForm').addClass('d-none');
                                    $('#OrderForm').removeClass('d-none');
                                    $('.harga').text('Rp. ' + response['data']['order']['payment_amount']);
                                    $("#ItemForm").trigger("reset");
                                }
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

            $('#order').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#OrderForm').serialize(),
                    url: "{{ route('new_order') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 300) {
                            Swal.fire({
                                icon: "error",
                                title: "Mohon Maaf !",
                                text: "Invalid Input, Try Again !"
                            });
                        } else {
                            let timerInterval
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu',
                                html: 'Sedang Menyiapkan Orderan Kamu',
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer()
                                        .querySelector(
                                            'b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal
                                            .getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log(response);
                                    $('#ItemForm').addClass('d-none');
                                    $('#OrderForm').addClass('d-none');
                                    $('.success').removeClass('d-none');
                                    $('.harga').text('Rp. ' + response['data']['order']['payment_amount']);

                                    // modal view
                                    $('#nama_pengirim').text(response['data']['order']['points'][0]['contact_person']['name']);
                                    $('#no_pengirim').text(response['data']['order']['points'][0]['contact_person']['phone']);
                                    $('#alamat_pengirim').text(response['data']['order']['points'][0]['address']);
                                    $('#nama_penerima').text(response['data']['order']['points'][1]['contact_person']['name']);
                                    $('#no_penerima').text(response['data']['order']['points'][1]['contact_person']['phone']);
                                    $('#alamat_penerima').text(response['data']['order']['points'][1]['address']);
                                    $('.invoice').text('Invoice ' + response['data']['order']['order_id']);
                                    $('.total').text('Rp. ' + response['data']['order']['payment_amount']);
                                }
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

        });

        $('#reload').click(function(e) {
            let timerInterval
            Swal.fire({
                icon: 'warning',
                title: 'Mohon Tunggu',
                html: 'Sedang Kembali Ke Fitur Cek Ongkir',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector(
                        'b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    $('#ItemForm').removeClass('d-none');
                    $('.succes').addClass('d-none');
                }
            });
        });

        $('#neworder').click(function(e) {
            let timerInterval
            Swal.fire({
                icon: 'warning',
                title: 'Mohon Tunggu',
                html: 'Memuat Halaman Baru Orderan Kamu',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector(
                        'b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    $('#OrderForm').removeClass('d-none');
                    $('.success').addClass('d-none');
                    $("#OrderForm").trigger("reset");
                }
            });
        });
    </script>
@endsection
