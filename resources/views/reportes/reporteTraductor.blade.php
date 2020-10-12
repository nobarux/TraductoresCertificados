@extends('Layouts.app')

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('/img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            {{-- <h1>Eesta es la pagina de los taductores</h1> --}}
          </div>
        </div>
      </div>
    </div>
  </header>
<!-- Main Content -->
@if (session('mensaje'))
  <div class="alert alert-success" role="alert" id="alerta" style="text-align:center">
    {{session('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-dismiss="alert">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="row py-1g-2">
          <div class="col-md-6"> 
            
          </div>
        </div>
        <div class="card mb-12">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Lista de traductores
            </div>
            <div class="card-body">
                <a class="btn btn-primary" href="{{ URL::to('/reporteTrad/pdf') }}">Export to PDF</a>
                <nav class="navbar navbar-light bg-light float-right">
                    <form class="form-inline">
                      <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                  </nav>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Idioma</th>
                                <th>Provincia</th>
                                <th>Registrado</th>
                                {{-- <th>Acciones</th> --}}
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th hidden>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Idioma</th>
                                <th>Provincia</th>
                                <th>Registrado</th>
                                {{-- <th>Acciones</th> 
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($reportes as $solicitud)
                                
                                <tr>
                                    <td hidden>{{ $solicitud->id }} </td>
                                    <td>{{ $solicitud->nombre }}</td>
                                    <td>{{ $solicitud->apellidos }} </td>
                                    <td>{{ $solicitud->idioma->descripcion }} </td>
                                    <td>{{ $solicitud->provincia->nombre }} </td>
                                    <td>{{ date('d-m-Y', strtotime($solicitud->created_at)) }} </td>
                                    
                                    {{-- <td> 
                                      <a href="/traductores/{{ $traductores['id'] }}/edit" ><i class="fa fa-edit"></i></a>   
                                      <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$traductores->id}})"><i class="fa fa-trash"></i></a>   
                                    </td> --}}
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

@endsection
