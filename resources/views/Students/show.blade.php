@extends('adminlte::page')

@section('title', 'OKUL BİLGİLERİ | Dashboard')

@section('content_header')
    <h1>Okul Bilgileri</h1>
@stop

@section('content')
   <h2> {{ $school->okul_adi}}</h2>
   <h3> {{ $school->il_adi}}</h3>
   <h3> {{ $school->ilce_adi}}</h3>
   <h5> {{ $school->tip}}</h5>
    <a href="{{ $school->okul_website}}">Okul Sitesi</a>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop

@section('plugins.Datatables', true)
