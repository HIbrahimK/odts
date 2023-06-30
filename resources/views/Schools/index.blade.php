@extends('adminlte::page')

@section('title', 'Roles | Dashboard')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div id="errorBox"></div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>List</h5>
                </div>
                <a class="float-right btn btn-primary btn-xs m-0" href="{{route('schools.create')}}"><i class="fas fa-plus"></i> Add</a>
            </div>
            <div class="card-body">
                <!--DataTable-->
                <div class="table-responsive">
                    <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Okul Adı</th>
                            <th>İli</th>
                            <th>İlçesi</th>
                            <th>Website</th>
                            <th>Tipi</th>
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
                ajax:"{{route('schools.index')}}",
                columns:[
                    {data:'id', name:'id'},
                    {data:'okul_adi', name:'okul_adi'},
                    {data:'il_adi', name:'il_adi'},
                    {data:'ilce_adi', name:'ilce_adi'},
                    {data:'okul_website', name:'okul_website'},
                    {data:'tip', name:'tip'},
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
                    var route = "{{route('schools.destroy', ':id')}}";
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
