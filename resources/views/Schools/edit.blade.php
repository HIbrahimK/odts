@extends('adminlte::page')

@section('title', 'Update Roles | Dashboard')

@section('content_header')
    <h1>Okul Bilgilerini Güncelle</h1>
@stop

@section('content')
   <div class="container-fluid">
        <div id="errorBox"></div>
        <form action="{{route('schools.update', $school->id)}}" method="POST">
            @method('patch')
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label"> Okul Adı <span class="text-danger"> *</span></label>
                        <input type="text" name="okul_adi" class="form-control" placeholder="For e.g. Manager" value="{{ucfirst($school->okul_adi)}}">
                        @if($errors->has('okul_adi'))
                            <span class="text-danger">{{$errors->first('okul_adi')}}</span>
                        @endif
                        <label for="okul_website" class="form-label"> Okul Adı <span class="text-danger"> *</span></label>
                        <input type="text" name="okul_website" class="form-control" placeholder="For e.g. Manager" value="{{ucfirst($school->okul_website)}}">
                        @if($errors->has('okul_website'))
                            <span class="text-danger">{{$errors->first('okul_website')}}</span>
                        @endif
                    </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </div>
        </form>
   </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop

