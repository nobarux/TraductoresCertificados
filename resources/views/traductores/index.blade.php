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
        <div class="row py-1g-2">
          <div class="col-md-6"> 
            <h1>Esta es la lista de traductores</h1>  
          </div>
          <div class="col-md-6">
            <a href="/traductores/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true" >
            Registro Nuevo
            </a>
          </div>
        </div>
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
                                <th hidden>Id</th>
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
                            @foreach ($trad as $traductores)
                                <tr>
                                    <td hidden>{{ $traductores->id }} </td>
                                    <td>{{ $traductores->nombre }} </td>
                                    <td>{{ $traductores->apellidos }} </td>
                                    <td>{{ $traductores->ci }} </td>
                                    <td>{{ $traductores->edad }} </td>
                                    <td>{{ $traductores->nacionalidad }} </td>
                                    <td>{{ $traductores->telefono }} </td>
                                    <td>{{ $traductores->email }} </td>
                                    <td> 
                                      <a href="/traductores/{{ $traductores['id'] }}/edit" ><i class="fa fa-edit"></i></a>   
                                      <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$traductores->id}})"><i class="fa fa-trash"></i></a>   

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
{{-- Modal para el delete --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminado de traductor</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">x</span>
      </button>
      </div>
      <div class="modal-body">Selecciona "Eliminar" si desea eliminar a este traductor</div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
        
      <form method="POST" action="" id="deleteForm" >
          @method('DELETE')
          @csrf
          {{-- <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a> --}}
          <button type=submit name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit()">Eliminar</button>
      </form>
      </div>
    </div>

  </div>

</div>
@section('jsModalDelete')
    

<script type=text/javascript>
  function deleteData(id)
  {
      var id = id;
      var url = '{{ route("traductores.destroy", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
  }

  function formSubmit()
  {
      $("#deleteForm").submit();
  }
</script>
@endsection
@endsection