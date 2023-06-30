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
                        <div class="card-body p-0">
                            <div class="bs-stepper linear">
                                <div class="bs-stepper-header" role="tablist">

                                    <div class="step active" data-target="#deneme-sec">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger"
                                                aria-selected="true">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Deneme Seç</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#sonuc-yukle">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger"
                                                aria-selected="false" disabled="disabled">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Deneme Sonuçlarını Yükle</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part2">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part2" id="information-part-trigger2"
                                                aria-selected="false" disabled="disabled">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Düzenleme Yapın</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part3">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part3" id="information-part-trigger3"
                                                aria-selected="false" disabled="disabled">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Ek Bilgileri Girin</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">

                                    <div id="deneme-sec" class="content active dstepper-block" role="tabpanel"
                                         aria-labelledby="logins-part-trigger">
                                        <div class="form-group">
                                            <label for="test" class="form-label">DENEME SEÇİNİZ</label>
                                            <select class="form-control select2" id="test"
                                                    data-placeholder="Deneme Seçiniz" name="test">
                                                @foreach ($tests as $test)
                                                    <option value="{{$test->id}}">{{ucfirst($test->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-primary" onclick="stepper.next()">İleri</button>

                                    </div>

                                    <div id="sonuc-yukle" class="content" role="tabpanel"
                                         aria-labelledby="information-part-trigger">

                                            <div class="card col-5">
                                                <div class="card-header">Yükleme</div>
                                                <div class="card-body">

                                                    <div class="col-md-auto">
                                                        <input type="file" name="file-input" id="file-input"
                                                               class="form-control float-right  ml-2">
                                                    </div>

                                                </div>
                                                <div class="card-footer col-md-auto">
                                                    <button type="submit" name="upload" id="upload"
                                                            class="btn float-right btn-success ml-2">
                                                        <i class="fas fa-upload"></i> Excelden Yazılar Yükle
                                                    </button>
                                                    @if($errors->has('file'))
                                                        <span class="text-danger">{{$errors->first('file')}}</span>
                                                    @endif
                                                </div>
                                            </div>


                                        @include('Tests.Tests.ayttablo')

                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">

                                        <button class="btn btn-primary" onclick="stepper.previous()">Geri</button>
                                        <button class="btn btn-primary" onclick="stepper.next()">İleri</button>
                                </div>


                                    <div id="information-part2" class="content" role="tabpanel"
                                         aria-labelledby="information-part-trigger">
                                        <div class="form-group">
                                            sayfa 3

                                            <button class="btn btn-primary" onclick="stepper.previous()">Geri</button>
                                            <button class="btn btn-primary" onclick="stepper.next()">İleri</button>

                                        </div>
                                    </div>

                                    <div id="information-part3" class="content" role="tabpanel"
                                         aria-labelledby="information-part-trigger2">
                                        <div class="form-group">
                                            <div class="card-body">
                                                ek bilgiler formu buraya gelecek
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="stepper.previous()">Geri</button>
                                        <button type="submit" class="btn btn-primary">Kaydet</button>
                                    </div>

                                </div>

                            </div>

                            <div class="card-footer">
                                <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">Sınav Yükleme
                                    Şablonuna İndirin</a> Deneme Yükleme Videosu İzleyin.
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

            <script> // BS-Stepper Init
                document.addEventListener('DOMContentLoaded', function () {
                    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                })
                $("#select2-select2-container").css('color', 'green');

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $('#myTable').DataTable({
                    reponsive:false, processing:true, serverSide:false,autoWidth:true, bPaginate:false,
                    scrollY:        "500px",
                    scrollX:        true,
                    scrollCollapse: true,
                    searching:false,
                    columnDefs: [
                        { width: '20%', targets: 0 }
                    ],
                    fixedColumns: true
                });
                $('#upload').on('click', function() {
                    var fileInput = $('#file-input')[0];
                    var file = fileInput.files[0];
                    var formData = new FormData();
                    formData.append('file', file);
                    $.ajax({
                        url: '{{ route('results.import') }}',
                        type: 'POST',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('.table-responsive').html(response);
                            console.log('yükleme tamam');
                        }
                    });
                });



            </script>
@stop
@section('plugins.bs-stepper', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
