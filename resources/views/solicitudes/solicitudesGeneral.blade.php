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
                
                <div class="table-responsive">
                    <div id="other" class="card-box table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
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
                                @foreach ($soli as $solicitudes)
                                    
                                    <tr>
                                        <td>{{ $solicitudes->nombre }}</td>
                                        <td>{{ $solicitudes->apellidos }} </td> 
                                        <td>{{ $solicitudes->listaidiomas($solicitudes->idioma)}} </td>
                                        <td>{{ $solicitudes->listaestados($solicitudes->estado)}} </td>
                                        <td> 
                                          <form method="POST"  action="/solicitudes/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            {{-- <a href="" type="submit">Cambio estado</a>    --}}
                                            {{-- <a href="javascript:;" onclick="deleteData({{$solicitudes->id}})"><i class="fa fa-trash"></i></a>    --}}
    
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit"><i class="fa fa-trash">Aprobar admisión examen</i></button>
                                          </form>
    
                                          <form method="POST"  action="/solicitudesPend/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">Pendiente Calif.</button>
                                          </form>
    
                                          <form method="POST"  action="/solicitudesAprob/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">Aprobar Solicitud</button>
                                          </form>
    
                                          <form method="POST"  action="/solicitudesSusp/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">Suspender Solicitud</button>
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
          ""
          var table = $('#datatable').DataTable({
              dom: 'Lfrtip',
              "ordering": true,
          "lengthChange": true
      });

      });

  </script>
@endsection

@endsection
