@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
            {{-- School Select field --}}
            <div class="input-group mb-3" >
                <select class="select2 form-control" data-live-search="true" name ="il_id" id="iller-dd">


                    @foreach($iller as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="input-group mb-3" >
                <select class="select2 form-control" disabled name="state" id="state" data-live-search="true">

                </select>
            </div>
            <div class="input-group mb-3" >
                <select class="select2 form-control" disabled data-live-search="true"  id="okul-dd" name="school_id">

                </select>
                @error('school_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#iller-dd').select2();

            $('#iller-dd').change(function(event) {
                var idCountry = this.value;
                $('state').html('');


                $.ajax({
                    url: "/api/fetch-state",
                    type: 'POST',
                    dataType: 'json',
                    data: {state_id: idCountry,_token:"{{ csrf_token() }}"},

                    success:function(response){
                        $.each(response.towns,function(index, val){
                            //console.log(val.ilceadi);
                            // $('#state-dd').append('<option data-tokens="'+val.id+'">'+ val.ilceadi +'</option>')
                            //$('#state-dd').add('<option data="'+val.id+'">'+ val.ilceadi +'</option>')
                            $('#state').append('<option value="'+val.id+'" data-value="'+val.name+'"> '+val.name+' </option>')

                        });
                        $('#state').removeAttr('disabled');
                        $('#okul-dd').select2();

                        // $('#city-dd').html('<option value="">Select City</option>');
                    }

                })
            });
            $('#state').change(function(event) {
                var idState = $( "#state option:selected" ).text();
                var idCountry = $( "#iller-dd" ).val();

                $('#okul-dd').html('');
                $.ajax({
                    url: "/api/fetch-cities",
                    type: 'POST',
                    dataType: 'json',
                    data: {town_id: idState.toLocaleLowerCase('tr'), city_id:idCountry, _token:"{{ csrf_token() }}"},
                    success:function(response){
                        //('#okul-dd').html('<option value="">Okul Seçin</option>');
                        console.log(response.schools);
                        $.each(response.schools,function(index, val){
                            $('#okul-dd').append('<option value="'+val.id+'" data-value="'+val.okul_adi+'"> '+val.okul_adi+' </option>')
                        });
                        $('#okul-dd').removeAttr('disabled');
                        $('#okul-dd').select2();
                    }

                })

            });
            $('#okul-dd').change(function(event) {
                var idState = $( "#state option:selected" ).text();
                var idCountry = $( "#iller-dd" ).val();
                var idSchool= $( "#okul-dd" ).val();
                console.log(idState);
                console.log(idCountry);
                console.log(idSchool);

            });


        });
    </script>
@stop
@section('plugins.Select2', true)
