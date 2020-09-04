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
                                <th>Solicitud</th>
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
                                <th>Solicitud</th>
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
                                    <td>{{ $solicitudes->num_Solicitud }} </td>
                                    {{-- <td><img src="{{asset('/storage/imagenesTraductores/'.$solicitudes->image_url)}}" alt="{{$solicitudes->image_url}}" width="80"> </td> --}}
                                    <td>{{ $solicitudes->estado->descripcion }} </td>
                                    <td> 
                                      <form method="POST"  action="/solicitudes/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        {{-- <a href="" type="submit">Cambio estado</a>    --}}
                                        {{-- <a href="javascript:;" onclick="deleteData({{$solicitudes->id}})"><i class="fa fa-trash"></i></a>    --}}

                                        <button type="submit" class="btn btn-primary btn-sm" value="submit">Aprobar examen</button>
                                      </form>
                                      <br>

                                      <form method="POST"  action="/solicitudesPend/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" value="submit">Pendiente Calif.</button>
                                      </form>
                                      <br>

                                      <form method="POST"  action="/solicitudesAprob/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" value="submit">Aprobar Solicitud</button>
                                      </form>
                                      <br>

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
  {{-- <script type=text/javascript>
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("solicitudes.aprobadosUpdate", ":id") }}';
        console.log(url);
        url = url.replace(':id', id);
        $("#changeForm").attr('action', url);
    }
  
    function formSubmit()
    {
        $("#changeForm").submit();
    }
  </script> --}}
  <hr>
@endsection
