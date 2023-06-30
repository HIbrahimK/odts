@extends('adminlte::page')

@section('title', 'Update Users | Dashboard')

@section('content_header')
    <h1>Update Users</h1>
@stop

@section('content')
   <div class="container-fluid">
    <div class="row">
        <div id="errorBox"></div>
        <div class="col-3">
            <form method="POST" action="{{route('levels.update', $level->id)}}">
                @method('patch')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Update User</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="level" class="form-label">Seviye <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="level" placeholder="Enter Full Name" value="{{$level->level}}">
                            @if($errors->has('level'))
                                <span class="text-danger">{{$errors->first('level')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Sınıf Adı <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Users Email" value="{{$level->name}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    <input type="hidden" name="school_id" value="{{$level->school_id}}">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
   </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(function (){
        $('#select2').select2();
    });
</script>
@stop
@section('plugins.Select2', true)
