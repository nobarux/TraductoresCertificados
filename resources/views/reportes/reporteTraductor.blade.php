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
      <div class="col-lg-10 col-md-10 mx-auto">
        <div class="row py-1g-2">
          <div class="col-md-6"> 
            
          </div>
        </div>
        <div class="card mb-12">
            <div class="card-header" style="text-align: center;">
                <h4><i class="fas fa-table mr-1"></i>
                  Lista de traductores
                </h4>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <div id="other" class="card-box table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Carnet</th>
                                    <th>Sexo</th>
                                    <th>Tipo Certificación</th>
                                    <th>Estado</th>
                                    <th>Pasarela</th>
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
                                        <td>{{ $reporte->carnet }} </td> 
                                        <td>{{ $reporte->sexo }} </td>
                                        <td>{{ $reporte->listacertificacion($reporte->certificacion)}} </td>
                                        <td>{{ $reporte->listaestados($reporte->estado)}} </td>
                                        <td>{{ $reporte->Pasarela }} </td>
                                        <td>{{ $reporte->listaidiomas($reporte->idioma)}} </td>
                                        <td>{{ $reporte->listaprovincias($reporte->provincia)}} </td>
                                        <td>{{ $reporte->listaprofesion($reporte->profesion)}} </td>
                                        <td data-order="{{ strtotime($reporte->created_at)}}" > {{ date('d-m-Y', strtotime($reporte->created_at)) }}</td>
                                        
                                        {{-- <td> 
                                        <a href="/traductores/{{ $traductores['id'] }}/edit" ><i class="fa fa-edit"></i></a>   
                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$traductores->id}})"><i class="fa fa-trash"></i></a>   
                                        </td> --}}
                                    </tr>
                                
                                @endforeach
                                <img hidden id=imageid src=/img/logoSmall.png/>
                            </tbody>

                            <tfoot>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Apellidos</th>
                                  <th>Carnet</th>
                                  <th>Sexo</th>
                                  <th>Tipo Certificación</th>
                                  <th>Estado</th>
                                  <th>Pasarela</th>
                                  <th>Idioma</th>
                                  <th>Provincia</th>
                                  <th>Profesión</th>
                                  <th>Registro</th>
                              </tr>
                          </tfoot>
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
  //Crea un input por cada elemento q exista en este caso en el footer de la tabla.
  $('#datatable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar por '+title+'" />' );
    } );  

  
  //DataTables
    var table = $('#datatable').DataTable({
      initComplete: function () 
      {
            // Apply the search
            this.api().columns().every( function () 
            {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () 
                {
                    if ( that.search() !== this.value ) 
                    {
                        that
                            .search( this.value )
                            .draw();
                    }
                });
            });
      }
                    ,
          "dom": 'B<f<t><"#df"<"pull-left" i><"pull-right"p><"pull-right"l>>>',
         "lengthChange": true,
         "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "Todos"]],
        searching: true,
        language: {
                url: "/vendor/jQueryDT/Spanish.json"
            },
        order : [[8,"asc"]]
            ,
        "buttons": [
				{
					text: 'Exportar a PDF',
					extend: 'pdfHtml5',
					orientation: 'portrait', 
					pageSize: 'A4', //A3 , A5 , A6 , legal , letter
					download: 'open',
					customize: function (doc) {
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
            var cantElem = table.data().count();
            // Logo converted to base64
            var logo = "data:image/png;base64,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";
						// Set page margins [left,top,right,bottom] or [horizontal,vertical]
						// or one number for equal spread
						// It's important to create enough space at the top for a header !!!
						doc.pageMargins = [60,60,60,30];
						// Set the font size fot the entire document
						doc.defaultStyle.fontSize = 7;
						// Set the fontsize for the table header
						doc.styles.tableHeader.fontSize = 7;
						// Create a header object with 3 columns
						// Left side: Logo
						// Middle: brandname
						// Right side: A document title
						doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 80
									},
									{
										alignment: 'center',
										text: 'REPORTE DE LAS SOLICITUDES INSCRITAS',
										fontSize: 10,
										margin: [0,0,100,0]
									}
									
								],
								margin: 20
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Creado el: ', { text: jsDate.toString() }]
                  },
                  {
                    alignment: 'center',
										text: ['Cantidad Traductores: ', { text: cantElem.toString() }]
                  },
									{
										alignment: 'right',
										text: ['página ', { text: page.toString() },	' de ',	{ text: pages.toString() }]
                  }
                  
								],
								margin: 20
							}
						});
						// Change dataTable layout (Table styling)
						// To use predefined layouts uncomment the line below and comment the custom lines below
						// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
						var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
				}
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
