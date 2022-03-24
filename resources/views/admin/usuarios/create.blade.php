@extends('admin.layouts.dashboard')
@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
      <h1>Registro de nuevo usuario</h1>
      
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
        <form method="POST" action="/usuarios" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre" value="{{old('name')}}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}">
            </div>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" required minlength="8" >
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="password_confirmation">Confirmar contaseña</label>
              <input type="password" class="form-control" id="password_confirmation" placeholder="Confirmar Contraseña" name="password_confirmation" required minlength="8" >
            </div>

            <div class="form-group col-md-4">
                <label for="role">Seleccionar rol</label>
                
            </div>
            <div id="selectPermiso">
                
            </div>
            
          </div>
          <br>
          <button type="submit" class="btn btn-primary" value="submit">Registrar</button>
          <a class="btn btn-danger" href="{{ url()->previous() }}" >Átras</a>   
        </form>
        
      </div>
    </div>
  </div>
@endsection