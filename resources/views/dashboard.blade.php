@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Hoşgeldiniz -> {{$users->name}}</p>
   <p>Okulunuz {{$users->school->okul_adi}}</p>
   <p>İliniz {{$users->school->il_adi}}</p>
   <p>İlçeniz {{$users->school->ilce_adi}}</p>
    <x-adminlte-input-file name="file" label="dosya ekle" legend="Şeçiniz" igroupsize="lg" placeholder="Bir dosya ekle">
        <x-slot name="appendSlot">
            <x-adminlte-button theme="primary" label="Yükle"/>
        </x-slot>
        <x-slot name="prependSlot">
            <div class="input-group-text text-primary">
                <i class="fas fa-file-upload"></i>
            </div>
        </x-slot>
    </x-adminlte-input-file>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
