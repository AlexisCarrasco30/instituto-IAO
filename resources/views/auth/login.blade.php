 {{-- @extends('layouts.app')  --}}
 @extends('layouts.plantillaBase') 
<style>
body{
background-color:rgb(0, 109, 151) !important;
font-family: 'Gluten', cursive;
}
.login{
    margin:30px;
    padding-top:100px;
   
    font-family: 'Tilt Neon', cursive;
    
}.label´{
    padding:0px;

}
.card{
    border-radius: 0px !important;
   
    font-size: 20px;
    box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
}
img{
 padding-left: 50px;
 height:80px;
 width:180px;
}
.boton{
    background-color:rgb(0, 109, 151) !important;
    color:#ffffff !important;
    
    text-align:center;
    width: 100px;
    height: 40px;
}
.boton:hover{
    background-color:rgb(2, 89, 124) !important; 
    box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75) !important; 
-webkit-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75)!important; 
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75)!important; 
transform: scale(1.1)!important ;
-webkit-transform: scale(1.1)!important ;
-moz-transform: scale(1.1)  !important;
}

</style>


@section('contenido')
<div class="container">

    <div class="row justify-content-center login">
     
        <div class="col-md-8 ">
            <div class="card">
                <!-- <div class="card-header container-fluid d-flex justify-content-center">{{ __('iniciar sección') }}</div> -->

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- <div class="container-fluid d-flex justify-content-center ">
                            <img src=""  height="150" width="150"> 
                        </div> -->
                        <div class="form-group row text-center">
                            <div class="col-md-12 m-1 p-2">
                            <img src="./imagenes/logo_instituto.png" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-end ">{{ __('Usuario') }}</label>

                            <div class="col-md-6 m-1 p-1">
                                
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="password" class="col-md-4 col-form-label text-md-end ">{{ __('Contraseña') }}</label>

                            <div class="col-md-6  m-1 p-1">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label fs-6" for="remember">
                                        {{ __('Recordar contraseña') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4 text-start p-2">
                                @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('¿Desea Guardar la contraseña?') }}
                                            </a>
                                @endif
                            </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-md-end p-2">
                                <button type="submit" class="btn btn boton">
                                    {{ __('Entrar') }}
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

