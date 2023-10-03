@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_ga')
@endsection

@section('btn-pesan')
    <a class="btn btn-sm ms-auto bg-gradient-success" href="/ga/riwayat-pesanan">Pesan</a>
@endsection

@section('content')
    @include('component.pesanmenu')
@endsection
