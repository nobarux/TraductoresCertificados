@extends('Layouts.app')

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
            <div class="card-header" style="text-align: center;">
                <h4><i class="fas fa-table mr-1"></i>
                Lista de Solicitudes Desaprobadas</h4>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <div id="other" class="card-box table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Idioma</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($soliSuspensas as $solicitudes)
                                    
                                    <tr>
                                        <td>{{ $solicitudes->nombre }}</td>
                                        <td>{{ $solicitudes->apellidos }} </td> 
                                        <td>{{ $solicitudes->listaidiomas($solicitudes->idioma) }} </td>
                                        <td>{{ $solicitudes->listaestados($solicitudes->estado) }} </td>
                                        <td> 
                                          <form method="POST" id="changeForm" action="/solicitudesReclamar/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            
                                            <button type="submit" class="btn btn-primary btn-xs" value="submit">
                                              <i class="fa fa-redo"></i>  Reclamar Solicitud
                                            </button>
                                          </form>
                                          
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
</div>

@section('dataTableJS')
<script type=text/javascript>
      $(document).ready(function () {
          var table = $('#datatable').DataTable({
              dom: 'frtipl',
              "lengthChange": true,
         "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "Todos"]],
              "ordering": true,
          "lengthChange": true,
          language: {
            url: "/vendor/jQueryDT/Spanish.json"
        }
      });

      });

      //Parte del autocerrado del alert cuando e inserta un nuevo registro
      $("#alerta").fadeTo(5000,500).slideUp(500,function() {
          $("#alerta").slideUp(500);
        })
  </script>
@endsection

@endsection
