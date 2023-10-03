@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_ga')
@endsection

@section('btn-edit-pesanan')
    <a class="btn btn-sm ms-auto bg-gradient-warning" href="/ga/riwayat-pesanan">Ubah</a>
@endsection

@section('content')
    @include('component.ubahpesanan')
@endsection
