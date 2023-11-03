@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_ga')
@endsection

@section('btn-tambah')
<button class="btn btn-sm ms-auto bg-gradient-success" type="button" onclick="showConfirmation()">Tambah</button>
@endsection

@section('btn-ubah')
<button class="btn btn-sm ms-auto bg-gradient-warning" type="button" onclick="ushowConfirmation()">Ubah</button>
@endsection

@section('content')
    @include('component.kelolapengguna')
@endsection

@section('bread')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kelola Pengguna</li>
    </ol>
    <h4 class="font-weight-bolder text-white mb-0 mt-3">Manajemen Pengguna</h4>
</nav>
@endsection

