@extends('Layouts.app')

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('/img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Eesta es la pagina de los taductores</h1>
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
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>CI</th>
                                <th>Edad</th>
                                <th>Nacionalidad</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>CI</th>
                                <th>Edad</th>
                                <th>Nacionalidad</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($trad as $traductor)
                                <tr>
                                    <td>{{ $traductor->nombre }} </td>
                                    <td>{{ $traductor->apellidos }} </td>
                                    <td>{{ $traductor->ci }} </td>
                                    <td>{{ $traductor->edad }} </td>
                                    <td>{{ $traductor->nacionalidad }} </td>
                                    <td>{{ $traductor->telefono }} </td>
                                    <td>{{ $traductor->email }} </td>
                                    <td> ....... </td>
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