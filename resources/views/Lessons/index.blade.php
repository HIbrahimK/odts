@extends('adminlte::page')

@section('title', 'Dersler | Panel')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
   <div class="container-fluid">
    <div class="row">
        <div id="errorBox"></div>
        <div class="col-3">
            <form method="POST" action="{{route('lessons.store')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Add New</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">

                        <div class="form-group">
                            <label for="name" class="form-label">Ders Adı <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" name="name" placeholder="Ders Adını Yazınız" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ekle</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>List</h5>
                    </div>
                </div>
                <div class="card-body">
                    <!--DataTable-->
                    <div class="table-responsive">
                        <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr>

                                    <th>İsim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
    $(function (){
        $('#select2').select2();
    });
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(document).ready(function(){
        var table = $('#tblData').DataTable({
            reponsive:true, processing:true, serverSide:false, autoWidth:false,
            ajax:"{{route('lessons.index')}}",
            columns:[
                {data:'id', name:'id' ,                                                                                                                                                                                                                                                                  visible: false},

                {data:'name', name:'name'},

                {data:'action', name:'action', bSortable:false, className:"text-center"},
            ],
            order:[[0, "asc"]]
        });
        $('body').on('click', '#btnDel', function(){
            //confirmation
            var id = $(this).data('id');
            if(confirm('Delete Data '+id+'?')==true)
            {
                var route = "{{route('lessons.destroy', ':id')}}";
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
@section('plugins.Select2', true)
