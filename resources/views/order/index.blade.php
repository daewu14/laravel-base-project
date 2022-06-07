@extends('layouts.admin.master')

@section('title')
    Payment Gateway
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
            @foreach ($data as $item)
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <i class="fab fa-whatsapp"></i> Order #{{ $item->number }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">Rp. {{ number_format($item->total_price, 2, ',', '.') }}</p>
                            <a href="{{ route('orders.show', $item->id)}}" class="btn btn-outline-primary d-blok"><i class="fas fa-shopping-cart"></i> Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
