@extends('admin.layouts.dashboard')
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
    <h1>Esto es la pagina de usuarios</h1>
    

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
                                    <th>Email</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($usuarios as $users)
                                    <tr>
                                        <td>{{ $users->name }} </td>
                                        <td>{{ $users->email }} </td>
                                        <td>{{ $users->created_at }} </td>
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
    </div>
</div>
@endsection