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

                                    <div class="line"></div>
                                    <div class="step" data-target="#sonuc-yukle">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger"
                                                aria-selected="false">
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

                                </div>
                                <div class="bs-stepper-content">

                                    <div id="sonuc-yukle" class="content" role="tabpanel"
                                         aria-labelledby="information-part-trigger">

                                        <div class="card col-5">
                                            <div class="card-header">Yükleme</div>
                                            <form method="post" action="{{ route('results.import') }}" enctype="multipart/form-data">
                                                @csrf
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
                                            </form>
                                        </div>


                                        @include('Tests.Results.ayttablo')

                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <div class="form-group  text-right">

                                            <button class="btn btn-primary" onclick="stepper.next()">İleri</button>
                                        </div>
                                    </div>


                                    <div id="information-part2" class="content" role="tabpanel"
                                         aria-labelledby="information-part-trigger">
                                        @include('Tests.Results.ekbilgiler')
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <div class="form-group  text-right">
                                            <button class="btn btn-primary" onclick="stepper.previous()">Geri</button>
                                            <button type="submit" class="btn btn-primary">Kaydet</button>

                                        </div>
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

            .red {
            background-color: red;
            color:red
            }

        @stop

        @section('js')

            <script> // BS-Stepper Init
                document.addEventListener('DOMContentLoaded', function () {
                    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                })
                $("#select2-select2-container").css('color', 'green');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })



            </script>
@stop
@section('plugins.bs-stepper', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
