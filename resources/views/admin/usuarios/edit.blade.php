
@extends('admin.layouts.dashboard')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
      <div class="row">
        <h1>Editar a un usuario</h1>
        
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mb-8">
            {{-- <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div> --}}
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
              <form method="POST" action="/usuarios/{{ $user->id }}" enctype="multipart/form-data">
                @method('PATCH')  
                @csrf
                {{-- {{csrf_field()}} --}}

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" value="{{$user->name}}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="apellidos">Apellido</label>
                      <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{$user->email}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lugar_Nac">Lugar de nacimiento</label>
                    <input type="text" class="form-control" id="lugar_Nac" name="lugar_Nac"  value="{{$user->lugar_Nac}}" >
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">Registrar</button>
                  </div>  
                </form>  
            </div>
          </div>
        </div>
              
          
      </div>
    </div>

@endsection
