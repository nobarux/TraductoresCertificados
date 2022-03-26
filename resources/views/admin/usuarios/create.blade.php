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
                <select class="form-control" name="role" id="role">
                  <option value="">Seleccioné el rol</option>
                  @foreach ($roles as $role)
                    <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->nombre}}</option>
                  @endforeach
                </select>
                
            </div>
            <div class="form-group col-md-8" id="selectPermiso">
                <label for="permisos">Seleccioné el permiso</label>
                <div class="form-group col-md-4" id="lista_permisos">
                </div>
            </div>
            
          </div>
          <br>
          <button type="submit" class="btn btn-primary" value="submit">Registrar</button>
          <a class="btn btn-danger" href="{{ url()->previous() }}" >Átras</a>   
        </form>
        @section('js_usuario_pagina')
        <script>
          $(document).ready(function(){
            var selectPermiso = $('#selectPermiso');
            var lista_permisos = $('#lista_permisos');
            selectPermiso.hide();//Esconde el elemento completo segun el id q se le pase
            
            $('#role').on('change',function() {
              var role = $(this).find(':selected');
              var role_id = role.data('role-id');
              var role_slug = role.data('role-slug');
              lista_permisos.empty();
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
    </div>
  </div>
@endsection