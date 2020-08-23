
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

        <form method="POST" action="/traductores" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre">
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido</label>
              <input type="text" class="form-control" id="apellido">
            </div>
          </div>
          <div class="form-group">
            <label for="nacimiento">Lugar de nacimiento</label>
            <input type="text" class="form-control" id="nacimiento" >
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="edad">Edad</label>
              <input type="text" class="form-control" id="edad">
            </div>
            <div class="form-group col-md-4">
              <label for="nacionalidad">Nacionalidad</label>
              <input type="text" class="form-control" id="nacionalidad">
            </div>
            <div class="form-group col-md-4">
              <label for="prof">Profesión/Ocupación</label>
              <input type="text" class="form-control" id="prof">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="ci">CI</label>
              <input type="number"  class="form-control" id="ci">
            </div>
            <div class="form-group col-md-4">
              <label for="telefono">Telefono</label>
              <input type="number" class="form-control" id="telefono">
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email">
            </div>
          </div>
          <br>
          <div class="form-row">
            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagen" lang="es">
                <label class="custom-file-label" for="imagen">Imagen(Opcional)</label>
              </div>
            </div>

            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="antecedentes">
                <label class="custom-file-label" for="antecedentes">Antecedentes Penales(Opcional)</label>
              </div>
            </div>

            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="curriculum">
                <label class="custom-file-label" for="curriculum">Curriculum(Opcional)</label>
              </div>
            </div>
            
            
          </div>  
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="idioma">Idioma</label>
              <select id="idioma" class="form-control">
                <option selected>Choose...</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
            </div>
            
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
        
      </div>
    </div>
  </div>

  <hr>
  @endsection