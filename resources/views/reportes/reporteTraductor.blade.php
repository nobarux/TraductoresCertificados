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
                
                <div class="table-responsive">
                    <div id="other" class="card-box table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Idioma</th>
                                    <th>Provincia</th>
                                    <th>Profesión</th>
                                    <th>Registrado</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($reportes as $reporte)
                                    
                                    <tr>
                                        <td>{{ $reporte->nombre }}</td>
                                        <td>{{ $reporte->apellidos }} </td> 
                                        <td>{{ $listaidioma[0]->nombre}} </td>
                                        <td>{{ $listaprov[0]->nombre}} </td>
                                        <td>{{ $listaprof[0]->nombre}} </td>
                                        <td>{{ date('d-m-Y', strtotime($reporte->created_at)) }} </td>
                                        
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
</div>

@section('dataTableJS')
<script type=text/javascript>
$(document).ready(function () {
    ""
    var table = $('#datatable').DataTable({
        dom: 'Bfrtip',
        "ordering": true,
    "lengthChange": true,

    buttons:[{
        
    extend:'pdfHtml5',
            text:'Exportar a PDF',
            pageSize: 'Letter',
            orientation: 'portrait',
            download: 'open'
        },
        {
            extend: 'print',
            text: 'Imprimir',
            orientation:'portrait'
        }
    
    ]
});
table.buttons().container().appendTo($('#other .col-sm-6:eq(0)', table.table().container()))

});


    
</script>
@endsection

@endsection
