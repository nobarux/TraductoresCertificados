@extends('admin.layouts.dashboard')
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
      <h1>Registro de nuevo rol</h1>
      

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
        <form method="POST" action="/roles" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="role_nombre">Nombre</label>
              <input type="text" class="form-control" name="role_nombre" id="role_nombre" value="{{old('role_nombre')}}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="role_slug">Slug</label>
              <input type="text" class="form-control" id="role_slug" name="role_slug" value="{{old('role_slug')}}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="role_permisos">Permisos</label>
            <input type="text" data-role="tagsinput" style="width: 100%" class="form-control" id="role_permisos" name="role_permisos"  value="{{old('role_permisos')}}" required>
          </div>
            
          <br>
          <button type="submit" class="btn btn-primary" value="submit">Registrar</button>
          <a class="btn btn-danger" href="{{ url()->previous() }}" >Átras</a>   
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

  @section('cssTags' )
    <link href="/css/admin/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
  @endsection

  @section('jsTags' )
    <script src="/js/admin/bootstrap-tagsinput.js"></script>
    <script>
      $(document).ready(function(){
        $('#role_nombre').keyup(function (e) { 
          var str = $('#role_nombre').val();
          str = str.replace(/\W+(?!$)/g,'-').toLowerCase();//Reemplaza espcacio por una -
          $('#role_slug').val(str);
          $('#role_slug').attr('placeholder',str);
        });
      })
    </script>
  @endsection