
@extends('admin.layouts.dashboard')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
      <div class="row">
        
        
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mb-8">
            <div class="card-header">
              <h1>{{$user->name}}</h1>
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
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                  </div>
                 <div class="form-group">
                   <label for="password">Contraseña</label>
                   <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña..." minlength="8">
                 </div>
                 <div class="form-group">
                  <label for="password_confirm">Confirmar Contraseña</label>
                  <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmar Contraseña..." minlength="8">
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
