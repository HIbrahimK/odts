@extends('adminlte::page')

@section('title', 'Create Roles | Dashboard')

@section('content_header')
    <h1>Create Roles</h1>
@stop

@section('content')
   <div class="container-fluid">
        <div id="errorBox"></div>
        <form action="{{route('schools.store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label"> Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Okul Adını Giriniz" value={{old('name')}}>
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <label for="name" class="form-label"> Assign Permissions <span class="text-danger"> *</span></label>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Role</button>
                </div>
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

@section('plugins.Datatables', true)
