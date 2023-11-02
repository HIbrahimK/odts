@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sonuç Yükleme Ekranı</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">SONUÇ YÜKLEME</h3>
                        </div>
                        <div class="col-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h5>Deneme Listesi</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--DataTable-->
                                    <div class="table-responsive">
                                        <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Deneme Adı</th>
                                                <th>Deneme Yayını</th>
                                                <th>Deneme Tarihi</th>
                                                <th>Seviyesi</th>
                                                <th>Türü</th>
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
            </div>
        </div>
        @stop

        @section('css')

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
                        reponsive:true, processing:true, serverSide:true, autoWidth:false,
                        ajax:"{{route('results.index')}}",
                        columns:[
                            {data:'id', name:'id', visible:false},
                            {data:'name', name:'name'},
                            {data:'publisher', name:'publisher'},
                            {data:'test_date', name:'test_date'},
                            {data:'level', name:'level'},
                            {data:'type', name:'type'},
                            {data:'action', name:'action', bSortable:false, className:"text-center"},
                        ],
                        order:[[0, "desc"]]
                    });
                    $('body').on('click', '#btnDel', function(){
                        //confirmation
                        var id = $(this).data('id');
                        if(confirm('Delete Data '+id+'?')==true)
                        {
                            var route = "{{route('tests.destroy', ':id')}}";
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
@section('plugins.bs-stepper', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
