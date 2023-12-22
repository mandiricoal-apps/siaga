@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_hrd')
@endsection

@section('content')
    @include('component.profile')
@endsection

@section('bread')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
    </ol>
    <h4 class="font-weight-bolder text-white mb-0 mt-3">Profile</h4>
</nav>
@endsection
