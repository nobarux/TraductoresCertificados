
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
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Contraseña..." minlength="8">
                </div>

                {{-- Espacio para poner roles --}}
                <div class="form-group">
                  <label for="role">Seleccionar rol</label>
                  <select class="form-control" name="role" id="role">
                    <option value="">Seleccioné el rol</option>
                    @foreach ($roles as $role)
                      <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{$user->roles->isEmpty() || $role->nombre != $userRoles->nombre ? "" : "selected"}}>{{$role->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                {{-- ---------------------------- --}}

                {{-- Espacio para permisos --}}
                
                <div class="form-group col-md-8" id="selectPermiso">
                  <label for="permisos">Seleccioné el permiso</label>
                  <div class="form-group col-md-4" id="lista_permisos">
                  </div>
                </div>

                @if ($user->permisos->isNotEmpty())
                  @if ($rolesPermisos != null)
                    <div class="form-group col-md-8" id="permisosUsarioCaja">
                      <label for="permisos">Permisos del usuario</label>
                      <div class="form-group col-md-4" id="lista_permisos_usuario">
                        @foreach ($rolesPermisos as $permisos)
                        <div class = "form-group col-md-4">
                          <input class= "form-control" type="checkbox" name="permisos[]" id="{{$permisos->slug}}" value="{{$permisos->id}}" {{ in_array($permisos->id, $usuariosPermisos->pluck('id')->toArray()) ? 'checked="checked"' : '' }}>
                          <label  for="{{$permisos->slug}}"> {{$permisos->nombre}}  </label>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                @endif
                {{-- ---------------------------- --}}
                
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">Editar</button>
                  </div>  
                </form>  

        @section('js_usuario_pagina') 
          <script>
            $(document).ready(function(){
              var selectPermiso = $('#selectPermiso');
              var lista_permisos = $('#lista_permisos');
              var selectUsuarioPermiso = $('#permisosUsarioCaja');
              var lista_usuario_permisos = $('#lista_permisos_usuario');
              selectPermiso.hide();//Esconde el elemento completo segun el id q se le pase
              
              $('#role').on('change',function() {
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');
                lista_permisos.empty();
                lista_usuario_permisos.empty();
                //console.log(role_id);
                $.ajax({
                  url: "/usuarios/create",
                  method: "get",
                  dataType: "json",
                  data: {
                    role_id : role_id,
                    role_slug: role_slug, 
                  }            
                }).done(function(data){
                console.log(data);
                selectPermiso.show();
                $.each(data,function(index,element){
                  $(lista_permisos).append(
                    '<div class = "form-group col-md-4">'+
                      '<input class= "form-control" type="checkbox" name="permisos[]" id="'+ element.slug +'" value="'+ element.id +'">' + 
                      '<label  for="'+ element.slug +'">' + element.nombre + '</label>' +
                    '</div>'
                  );
                });

                });
              });
            });
          </script>
            
        @endsection
            </div>
            <div class="card-footer">
              <a class="btn btn-primary" href="{{ url()->previous() }}" >Átras</a>   
            </div>
          </div>
        </div>
              
          
      </div>
    </div>

@endsection
