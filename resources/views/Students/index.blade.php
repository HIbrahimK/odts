@extends('adminlte::page')

@section('title', 'Öğrenciler | Dashboard')

@section('content_header')
    <h1>Öğrenciler</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div id="errorBox"></div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>List</h5>
                </div>

                <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-auto">
                        <input type="file" name="file" class="form-control float-right  ml-2">
                    </div>


                    <div class="col-md-auto">
                        <button type="submit" name="upload" id="upload" class="btn float-right btn-success ml-2">
                            <i class="fas fa-upload"></i> Excelden Yazılar Yükle
                        </button>
                        @if($errors->has('file'))
                            <span class="text-danger">{{$errors->first('file')}}</span>
                        @endif

                    </div>
                </form>
                <a class="float-right btn btn-primary btn-xs m-0" href="{{route('students.create')}}"><i class="fas fa-plus"></i> Add</a>
            </div>
            <div class="card-body">
                <!--DataTable-->
                <div class="table-responsive">
                    <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fotoğraf</th>
                            <th>Adı</th>
                            <th>Soyadı</th>
                            <th>Okul NO</th>
                            <th>TC</th>
                            <th>Telefon</th>
                            <th>Sınıfı</th>
                            <th>Sube</th>
                            <th>Okulu</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $(document).ready(function(){

            var table = $('#tblData').DataTable({
                reponsive:true, processing:true, serverSide:false, autoWidth:false,
                ajax:"{{route('students.index')}}",
                columns:[
                    {data:'id', name:'id', visible:false},
                    {data:'foto', name:'foto'},
                    {data:'name', name:'name'},
                    {data:'lastname', name:'lastname'},
                    {data:'school_no', name:'ilce_adi'},
                    {data:'tc', name:'tc'},
                    {data:'tel', name:'tel'},
                    {data:'level_id', name:'level_id'},
                    {data:'sube', name:'sube'},
                    {data:'school_id', name:'school_id'},
                    {data:'action', name:'action', bSortable:false, className:"text-center"},
                ],
                order:[[0, "asc"]],
                bDestory:true,
            });
            $('body').on('click', '#btnDel', function(){
                //confirmation
                var id = $(this).data('id');
                if(confirm('Delete Data '+id+'?')==true)
                {
                    var route = "{{route('students.destroy', ':id')}}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url:route,
                        type:"delete",
                        success:function(res){
                            console.log(res);
                            $("#tblData").DataTable().ajax.reload();
                        },
                        error:function(res){
                            $('#errorBox').html('<div class="alert alert-dander">'+response.message+'</div>');
                        }
                    });
                }else{
                    //do nothing
                }
            });


        });
    </script>
@stop

@section('plugins.Datatables', true)
