@extends('Layouts.app')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
           
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <h1>Registro de nuevo traductor</h1>
      

      <div class="col-lg-8 col-md-10 mx-auto">
        {{-- Esto sirve para q te salgan los errores de validacion en una lista --}}
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
        </div>
      @endif
    {{-- -------------------------------- --}}
        <form method="POST" action="/traductores" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre')}}">
            </div>
            <div class="form-group col-md-6">
              <label for="apellidos">Apellido</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{old('apellidos')}}">
            </div>
          </div>
          <div class="form-group">
            <label for="lugar_Nac">Lugar de nacimiento</label>
            <input type="text" class="form-control" id="lugar_Nac" name="lugar_Nac"  value="{{old('lugar_Nac')}}" >
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="edad">Edad</label>
              <input type="text" class="form-control" id="edad" name="edad"  value="{{old('edad')}}">
            </div>
            <div class="form-group col-md-4">
              <label for="nacionalidad">Nacionalidad</label>
              <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="{{old('nacionalidad')}}">
            </div>
            <div class="form-group col-md-4">
              <label for="prof_Ocup">Profesión/Ocupación</label>
              <input type="text" class="form-control" id="prof_Ocup" name="prof_Ocup"  value="{{old('prof_Ocup')}}">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="ci">CI</label>
              <input type="number" maxlength="11"  class="form-control" id="ci" name="ci" value="{{old('ci')}}">
            </div>
            <div class="form-group col-md-4">
              <label for="telefono">Telefono</label>
              <input type="number" min="1" max="9999999" class="form-control" id="telefono" name="telefono" value="{{old('telefono')}}">
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            </div>
          </div>
          <br>
          <div class="form-row">
            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image_url" name="image_url"  lang="es" >
                <label class="custom-file-label" for="image_url">Imagen(Opcional)</label>
              </div>
            </div>

            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="ant_penales" name="ant_penales" lang="es" >
                <label class="custom-file-label" for="ant_penales">Antecedentes Penales(Opcional)</label>
              </div>
            </div>

            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="curriculum" name="curriculum" lang="es" >
                <label class="custom-file-label" for="curriculum">Curriculum(Opcional)</label>
              </div>
            </div>
            
          </div>  
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="id_Idioma">Idioma</label>
              <select id="id_Idioma" class="form-control" name="id_Idioma">
                <option value="" selected>Selecciona un idioma</option>
                @foreach ($idioma as $idiomas)
                <option value="{{ $idiomas->id }}">{{ $idiomas->descripcion}}</option>
                @endforeach
              </select>
            </div>
            
          </div>
          <br>
          <button type="submit" class="btn btn-primary" value="submit">Registrar</button>
        </form>
        
      </div>
    </div>
  </div>

  <hr>
  @endsection
  @section('scriptNombreUpload' )
  <script type=text/javascript>
    $(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);
})
    
  </script>
      
  @endsection