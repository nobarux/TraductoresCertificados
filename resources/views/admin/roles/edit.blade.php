
@extends('admin.layouts.dashboard')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
<h1> Actualizar usuario</h1>

      <div class="row">
        
        
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mb-8">
            <div class="card-header">
              <h1>{{$roles->nombre}}</h1>
            </div>
            <div class="card-body">
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
              <form method="POST" action="/roles/{{ $roles->id }}" enctype="multipart/form-data">
                @method('PATCH')  
                @csrf

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="role_nombre">Nombre</label>
                      <input type="text" class="form-control" name="role_nombre" id="role_nombre" value="{{$roles->nombre}}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="role_slug">Slug</label>
                      <input type="text" class="form-control" name="role_slug" id="role_slug" value="{{$roles->slug}}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="role_permisos">Agregar Permisos</label>
                      <input type="text" data-role="tagsinput" class="form-control" id="role_permisos" name="role_permisos" value="" required>
                    </div>
                  </div>
                 

                {{-- Espacio para poner roles --}}

                {{-- ---------------------------- --}}
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">Editar</button>
                  </div>  
                </form>  
            </div>
            <div class="card-footer">
              <a class="btn btn-primary" href="{{ url()->previous() }}" >Átras</a>   
            </div>
          </div>
        </div>
              
          
      </div>
    </div>

@endsection
