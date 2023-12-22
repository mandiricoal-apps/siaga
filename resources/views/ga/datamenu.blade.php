@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_ga')
@endsection

@section('btn-menus')
    <a class="btn btn-sm ms-auto bg-gradient-primary" href="/departemen/pesan-menu">Pesan</a>
@endsection

@section('content')
    @include('component.datamenu')
@endsection

@section('bread')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Data Menu</li>
    </ol>
    <h4 class="font-weight-bolder text-white mb-0 mt-3">Data Menu</h4>
</nav>
@endsection
