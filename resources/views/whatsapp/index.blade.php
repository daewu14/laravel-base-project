@extends('layouts.admin.master')

@section('title')
    Whatsapp Device
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
            @forelse ($data as $item)
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <i class="fab fa-whatsapp"></i> Device #{{ $loop->iteration }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                                <a href="{{ route('show.whatsapp', $item->no_wa) }}" class="btn btn-primary"><i class="fa fa-cog"></i> Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('new.whatsapp') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama Lengkap <small
                                    class="text-danger">*</small></label>
                            <input type="text" name="name" class="form-control" id="nama" placeholder="Ex Anto"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-2">
                            <label for="number" class="form-label">Nomor Whatsapp<small
                                    class="text-danger">*</small></label>
                            <input type="number" name="number" class="form-control" id="number" placeholder="Ex 628xxx"
                                autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-3 float-end" id="saveBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
