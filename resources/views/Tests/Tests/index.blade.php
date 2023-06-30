@extends('adminlte::page')

@section('title', 'Sınavlar | Panel')

@section('content_header')
    <h1>DENEMELER</h1>
@stop

@section('content')
   <div class="container-fluid">
    <div class="row">
        <div id="errorBox"></div>
        <div class="col-3">
            <form method="POST" action="{{route('tests.store')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Yeni Deneme Ekle</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Deneme Adı <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Deneme Adını Yazınız" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="publisher" class="form-label">Yayıncı <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="publisher" placeholder="Deneme Yayın Evini Yazınız" value="{{old('email')}}">
                            @if($errors->has('publisher'))
                                <span class="text-danger">{{$errors->first('publisher')}}</span>
                            @endif
                        </div>
                        <div class="form-group">

                            <label for="test_date" class="form-label">Deneme tarihi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="test_date" value="{{old('password')}}">
                            @if($errors->has('test_date'))
                                <span class="text-danger">{{$errors->first('test_date')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="level" class="form-label">Sınıf Seviyesi <span class="text-danger">*</span></label>

                            <select class="form-control select2"  id="select2" data-placeholder="seviye Seçiniz" name="level">

                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type" class="form-label">Deneme Türü <span class="text-danger">*</span></label>

                            <select class="form-control select2"  id="type" data-placeholder="Deneme Turunu Seçiniz" name="type">

                                <option value="LGS">LGS</option>
                                <option value="TYT">TYT</option>
                                <option value="AYT">AYT</option>
                                <option value="ozel">ÖZEL DENEME</option>
                            </select>
                        </div>
                        <div class="form-grou Resource">
                            <label for="type" class="form-label">TYT Denemesini Seçiniz <span class="text-danger">*</span></label>

                            <select class="form-control select2" disabled id="tyt" data-placeholder="TYT Denemesini Seçiniz" name="test_id">
                                @foreach ($tests as $test)
                                    <option value="{{$test->id}}">{{ucfirst($test->name)}}</option>
                                @endforeach


                            </select>
                        </div>

                        <input type="hidden" name="school_id" value="{{Auth::user()->school_id}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
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
        document.querySelector('.Resource').style.visibility = "hidden"
        var table = $('#tblData').DataTable({
            reponsive:true, processing:true, serverSide:true, autoWidth:false,
            ajax:"{{route('tests.index')}}",
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
    $('#type').change(function(event) {
        var tip = this.value;
        console.log(tip);
        if (tip == 'AYT') {

        $('#tyt').removeAttr('disabled');
            document.querySelector('.Resource').style.visibility = "visible"

        }
        else{
            $('#tyt').prop('disabled', true);
            document.querySelector('.Resource').style.visibility = "hidden"
        }
    });


</script>
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
