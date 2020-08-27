@extends('Layouts.app')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Eesta es la pagina de las solicitudes en general</h1>
            <span class="subheading">This is what I do.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Idioma</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th hidden>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Idioma</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($soli as $solicitudes)
                                <tr>
                                    <td hidden>{{ $solicitudes->id }} </td>
                                    <td>{{ $solicitudes->nombre }} </td>
                                    <td>{{ $solicitudes->apellidos }} </td>
                                    <td>{{ $solicitudes->idioma->descripcion }} </td>
                                    {{-- <td><img src="{{asset('/storage/imagenesTraductores/'.$solicitudes->image_url)}}" alt="{{$solicitudes->image_url}}" width="80"> </td> --}}
                                    <td>{{ $solicitudes->estado->descripcion }} </td>
                                    <td> 
                                      <a href="/solicitudes/{{$solicitudes->id}}/edit">Cambio estado</a>   
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
      </div>
    </div>
  </div>

  <hr>
@endsection
