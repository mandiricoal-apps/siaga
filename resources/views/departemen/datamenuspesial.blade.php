@extends('layout.layout')

@section('sidebar')
    @include('sidebar.sb_departemen')
@endsection

@section('btn-menus')
    <a class="btn btn-sm ms-auto bg-gradient-primary" href="/departemen/pesan-menu">Pesan</a>
@endsection

@section('content')
    @include('component.datamenuspesial')
@endsection
