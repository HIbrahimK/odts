@extends('adminlte::page')

@section('title', 'Update Roles | Dashboard')

@section('content_header')
    <h1>Okul Bilgilerini Güncelle</h1>
@stop

@section('content')
   <div class="container-fluid">
        <div id="errorBox"></div>
        <form action="{{route('students.update', $student->id)}}" method="POST">
            @method('patch')
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label"> Adı <span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Öğrenci Adını Giriniz" value="{{$student->name}}">
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="form-label"> Soyadı <span class="text-danger"> *</span></label>
                        <input type="texta" name="lastname" class="form-control" placeholder="Soyadını Giriniz" value="{{$student->lastname}}">
                        @if($errors->has('lastname'))
                            <span class="text-danger">{{$errors->first('lastname')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="school_no" class="form-label"> okul no <span class="text-danger"> *</span></label>
                        <input type="digit" name="school_no" class="form-control" placeholder="okul numarası" value={{$student->school_no}}>
                        @if($errors->has('school_no'))
                            <span class="text-danger">{{$errors->first('school_no')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tc" class="form-label"> TC </label>
                        <input type="digit" name="tc" class="form-control" placeholder="TC" value={{$student->tc}}>
                        @if($errors->has('tc'))
                            <span class="text-danger">{{$errors->first('tc')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tel" class="form-label"> TEL </label>
                        <input type="digit" name="tel" class="form-control" placeholder="tel" value={{$student->tel}}>
                        @if($errors->has('tc'))
                            <span class="text-danger">{{$errors->first('tel')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="level_id" class="form-label"> TEL </label>

                        <select class="form-control select2" id="select2" data-placeholder="{{$student->level_id}}" name="level_id">
                            @foreach ($siniflar as $sinif)
                                <option value="{{ $sinif->id }}" {{ $sinif->id == $student->level_id ? 'selected' : '' }}>{{ucfirst($sinif->level)}}/{{ucfirst($sinif->name)}}</option>

                            @endforeach
                        </select>
                        @if($errors->has('level_id'))
                            <span class="text-danger">{{$errors->first('level')}}</span>
                        @endif

                    </div>
                    <input type="hidden" name="school_id" value="{{Auth::user()->school_id}}">

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Öğrenci Ekle</button>
                    </div>
                </div>
            </div>

        </form>
   </div>
@stop

@section('css')
@stop

@section('js')

@stop

