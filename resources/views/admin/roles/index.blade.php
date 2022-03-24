@extends('admin.layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 col-md-10 mx-auto">
        @if (session('mensaje'))
        <div class="alert alert-success" role="alert" id="alerta" style="text-align:center">
          {{session('mensaje')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
        
        {{-- <div class="card mb-4">
          <a href="/usuarios/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true" >
          Registro Nuevo
          </a>
        </div> --}}
        <div class="row py-1g-2">
            
            <div class="col-md-12" style="margin-top: 20px;">
                <a href="/roles/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true" >
                    Registro Nuevo
                    </a>
            </div>
          </div>
      <br>
        <div class="card mb-4">
            <div class="card-header" style="text-align:center;">
                <i class="fas fa-table mr-1"></i>
                Lista Roles
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dataTable" id="dataTable" width="169%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Slug</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Rol</th>
                                <th>Slug</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($roles as $rol)
                                <tr>
                                    <td>{{ $rol->nombre }} </td>
                                    <td>{{ $rol->slug }} </td>
                                    <td style="text-align: center">
                                        @if($rol->permisos != null)
                                            @foreach ($rol->permisos as $permisos)
                                                <span class="badge badge-primary">
                                                    {{$permisos->nombre}}
                                                </span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td style="text-align: center"> 
                                        <a type="button" class="btn btn-outline-primary" href="/roles/{{ $rol->id }}" >Ver</a>
                                        <a type="button" class="btn btn-outline-primary" href="/roles/{{ $rol->id }}/edit" >Editar</a>
                                        {{-- <a href="javascript:;" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{ $users['id'] }})">Eliminar</a>    --}}
                                        <hr/>
                                        <a  class="btn btn-outline-danger" href="javascript:;" data-toggle="modal" data-target="#deleteModal" id="borrar" onclick="deleteData({{ $rol['id'] }})">Eliminar</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Eliminado de Rol</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">¿Esta seguro que desea eliminar a este rol?</div>
        <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
        
        <form method="POST" action="" id="deleteForm" >
            @method('DELETE')
            @csrf
            {{-- <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a> --}}
            <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit()">Eliminar</button>
        </form>
        </div>
    </div>

    </div>

</div>

<script type=text/javascript>
    //Parte del autocerrado del alert cuando e inserta un nuevo registro
    $("#alerta").fadeTo(5000,500).slideUp(500,function() {
            $("#alerta").slideUp(500);
        })
    // var valor = document.getElementById('borrar').addEventListener('click',deleteData());

    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("roles.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
    }
    
    //Parte para poner al datatable en español 
  $(document).ready(function () {
      var table = $('#datatable').DataTable({
        dom: 'frtipl',
          "lengthChange": true,
     "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "Todos"]],
          "ordering": true,
      language: {
        url: "/vendor/jQueryDT/Spanish.json"
    }
  });

  });
    
</script>
@endsection