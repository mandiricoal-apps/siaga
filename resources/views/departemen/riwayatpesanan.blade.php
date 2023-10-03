@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_departemen')
@endsection

@section('btn-edit-riwayat')
    <a href="/departemen/ubah-pesanan" class="text-secondary text-s" data-toggle="tooltip" data-original-title="Edit">
        <span class="badge badge-md bg-gradient-warning"><i class="fa-solid fa-square-pen"></i><span>
    </a>
@endsection

@section('content')
    @include('component.riwayatpesanan')
@endsection
