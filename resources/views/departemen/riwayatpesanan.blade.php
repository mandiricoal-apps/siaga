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

@section('bread')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Riwayat Pesanan</li>
    </ol>
    <h4 class="font-weight-bolder text-white mb-0 mt-3">Riwayat Pesanan</h4>
</nav>
@endsection
