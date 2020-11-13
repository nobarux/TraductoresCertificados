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
      <div class="col-lg-10  mx-auto">
        <div class="row py-1g-2">
          <div class="col-md-6"> 
            
          </div>
        </div>
        <div class="card mb-12">
            <div class="card-header" style="text-align: center;">
                <h4><i class="fas fa-table mr-1"></i>
                  Lista de Solicitudes
                </h4>
            </div>
            <div class="card-body">
              @if (session('mensaje'))
              <div class="alert alert-success" role="alert" id="alerta" style="text-align:center">
                {{session('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
                <div class="table-responsive">
                    <div id="other" class="card-box table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    {{-- <th>Apellidos</th> --}}
                                    <th>Carnet</th>
                                    <th>Email</th>
                                    <th>Sexo</th>
                                    <th>Teléfono Fijo</th>
                                    <th>Teléfono Celular</th>
                                    {{-- <th>Provincia</th> --}}
                                    <th>Idioma</th>
                                    <th>Estado</th>
                                    <th>Registrado</th>
                                    <th>Acciones</th>
                                    <th>Impresión</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($soli as $solicitudes)
                                    
                                    <tr>
                                        <td>{{ $solicitudes->nombre. " " .$solicitudes->apellidos}}</td>
                                        {{-- <td>{{ $solicitudes->apellidos }} </td>  --}}
                                        <td>{{ $solicitudes->carnet }} </td> 
                                        <td>{{ $solicitudes->email }} </td> 
                                        <td>{{ $solicitudes->sexo }} </td>
                                        <td>{{ $solicitudes->telefono_fijo }} </td>
                                        <td>{{ $solicitudes->telefono_celular }} </td>
                                        {{-- <td>{{ $solicitudes->listaprovincias($solicitudes->provincia) }} </td>  --}}
                                        <td>{{ $solicitudes->listaidiomas($solicitudes->idioma)}} </td>
                                        <td>{{ $solicitudes->listaestados($solicitudes->estado)}} </td>
                                        <td data-order="{{ strtotime($solicitudes->created_at)}}" > {{ date('d-m-Y', strtotime($solicitudes->created_at)) }}</td>
                                        <td> 
                                          <button data-toggle="modal" onclick='showAprobarData("{{$solicitudes->id}}","{{$solicitudes->nombre}}",
                                          "{{$solicitudes->apellidos}}","{{$solicitudes->carnet}}","{{ $solicitudes->listacolor($solicitudes->colorP)}}",
                                          "{{ $solicitudes->listaprofesion($solicitudes->profesion)}}","{{$solicitudes->sexo}}","{{$solicitudes->direccion}}",
                                          "{{ $solicitudes->listaprovincias($solicitudes->provincia)}}","{{ $solicitudes->listamunicipio($solicitudes->municipio)}}",
                                          "{{$solicitudes->telefono_fijo}}","{{$solicitudes->telefono_celular}}","{{$solicitudes->email}}",
                                          "{{ $solicitudes->listaidiomas($solicitudes->idioma)}}","{{ $solicitudes->listacertificacion($solicitudes->certificacion)}}")' data-target="#showModal" class="btn btn-primary btn-sm">
                                            <i class="fa fa-folder-plus"></i> Aprobar admisión examen
                                          </button>
                                          {{-- <form method="POST"  action="/solicitudes/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                          </form> --}}
    
                                          <form method="POST"  action="/solicitudesPend/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">
                                              <i class="fa fa-stopwatch"></i>  Pendiente Calif.
                                            </button>
                                          </form>
    
                                          <form method="POST"  action="/solicitudesAprob/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">
                                              <i class="fa fa-check"></i>  Aprobar Solicitud
                                            </button>
                                          </form>
    
                                          <form method="POST"  action="/solicitudesSusp/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">
                                              <i class="fa fa-times-circle"></i>  Suspender Solicitud
                                            </button>
                                          </form>

                                            <button data-toggle="modal" onclick='showData("{{$solicitudes->id}}","{{$solicitudes->nombre}}","{{$solicitudes->apellidos}}")' data-target="#incModal" class="btn btn-primary btn-sm">
                                              <i class="fa fa-ban"></i>  Denegar inscripción
                                            </button>
                                        </td>
                                        <td>
                                          <a href="{{ route('solicitudes.descFoto', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar foto</a>
                                          <a href="{{ route('solicitudes.descCarnet1', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar carnet anverso</a>
                                          <a href="{{ route('solicitudes.descCarnet2', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar carnet reverso</a>
                                          <a href="{{ route('solicitudes.descTit', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar titulo</a>
                                          <a href="{{ route('solicitudes.descAnte', $solicitudes->id) }}" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar antecedentes</a>
                                          
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
{{-- Modal para el inscripciones rechazadas --}}
<div class="modal fade" id="incModal" tabindex="-1" role="dialog" aria-labelledby="incModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incModalLabel">Denegar Inscripción</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="Form" >
          {{-- @method('PATCH') --}}
          @csrf

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">¿Esta seguro que desea denegar esta inscripción?</label>
            <input class="form-control" id="nombre" name="nombre" type="text" readonly>
            <input class="form-control" id="oculto" name="oculto" type="text" hidden>
          </div>
          <div class="form-group">
            {{-- <label for="id_Idioma">Idioma</label> --}}
              <select id="id_Razones" class="form-control" name="id_Razones" required>
                <option value="" disabled selected>Selecciona una opción</option>
                  @foreach ($razon as $razones)
                    <option value="{{ $razones->idRazones }}">{{ $razones->descripciones}}</option>
                  @endforeach
              </select>
          </div>
          <div hidden class="form-group" id="textRazones">
            <label for="message-text" class="col-form-label">Observaciones:</label>
            <textarea class="form-control" id="razon" name="razon"></textarea>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit()">Denegar</button>
        </form>
        
      </div>
      </div>
    </div>

  </div>

</div>
{{-- Termino Modal para el inscripciones rechazadas --}}

{{-- Modal para el imprimir cert --}}
{{-- <div></div> --}}
<div class="modal fade bd-example-modal-lg" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showModalLabel">Certificación</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body" id="inscripcionModal">
        <form method="POST" action="" id="Form" >
          {{-- @method('PATCH') --}}
          @csrf

          <div class="form-group">
            <h5 style="position: absolute; right: 10px">CERT-01</h5>
            <br />
            <div class="text-center">
              <img src="../img/escudo.png" width="50px" alt="Fluid image" thumbnail>
              <h5>República de Cuba</h5>
            </div>
            <h6 class="text-center">Ministerio de Relaciones Exteriores</h6>

            <h3 class="text-center">
              Planilla para la solicitud de Inscripción a Exámenes de Certificación
              de Traductores e Intérpretes
            </h3>
          </div>
          <div class="form-group">
            <div class="col-8 col-sm-6">
              <label for="nombrePlanilla" class="col-form-label">Nombre(s)</label>
              <input class="form-control" id="nombrePlanilla" name="nombrePlanilla" type="text" readonly>
              {{-- <input class="form-control" id="ocultos" name="ocultos" type="text" > --}}
            </div>
            <div class="col-8 col-sm-6">
              <label for="apellidos" class="col-form-label">Apellidos</label>
              <input class="form-control" id="apellidos" name="apellidos" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="CI" class="col-form-label">Carnet de Identidad</label>
              <input class="form-control" id="CI" name="CI" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="colorP" class="col-form-label">Color de Piel</label>
              <input class="form-control" id="colorP" name="colorP" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="profesion" class="col-form-label">Profesión</label>
              <input class="form-control" id="profesion" name="profesion" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="sexo" class="col-form-label">Sexo</label>
              <input class="form-control" id="sexo" name="sexo" type="text" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="col-8 col-sm-12">
            <label for="message-text" class="col-form-label">Dirección</label>
            <textarea class="form-control" id="direccion" name="direccion" readonly></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-8 col-sm-6">
              <label for="provincia" class="col-form-label">Provincia</label>
              <input class="form-control" id="provincia" name="provincia" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="municipio" class="col-form-label">Municipio</label>
              <input class="form-control" id="municipio" name="municipio" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="telefono_fijo" class="col-form-label">Teléfono Fijo</label>
              <input class="form-control" id="telefono_fijo" name="telefono_fijo" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="telefono_celular" class="col-form-label">Teléfono Celular</label>
              <input class="form-control" id="telefono_celular" name="telefono_celular" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="correo" class="col-form-label">Correo electrónico</label>
              <input class="form-control" id="correo" name="correo" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="idioma" class="col-form-label">Idioma</label>
              <input class="form-control" id="idioma" name="idioma" type="text" readonly>
            </div>
            <div class="col-8 col-sm-6">
              <label for="certificación" class="col-form-label">Certificación a Solicitar</label>
              <input class="form-control" id="certificación" name="certificación" type="text" readonly>
            </div>
          </div>

          <div class="modal-footer">
            
            {{-- <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button> --}}
              <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit()"><i class="fa fa-print"></i> Guardar e Imprimir</button>
              <button type="button" name="printButton" id="printButton" class="btn btn-primary" ><i class="fa fa-print"></i> Imprimir </button>
        </form>
        
      </div>
      </div>
    </div>

  </div>

</div>

{{-- Termino Modal para el imprimir cert --}}


@section('dataTableJS')
<script src="print.js"></script>
<script type=text/javascript>
//Parte del autocerrado del alert cuando e inserta un nuevo registro
$("#alerta").fadeTo(5000,500).slideUp(500,function() {
    $("#alerta").slideUp(500);
  })
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
      
      $("#id_Razones").change(function() {
          var selectedOption = $(this).children("option:selected").text();
          document.getElementById("oculto").value = selectedOption;
          if (selectedOption == "Otros") {
            $("#textRazones").removeAttr('hidden');
          }
          else
          {
            $("#textRazones").attr("hidden",true);
            $("#razon").val('');
          }
          
        })

        $("#printButton").click(function(){
          // alert("aaaaa");
          $("#inscripcionModal").printThis({
            debug: false,                //show the iframe for debugging
            importCSS: true,             //import page CSS
            importStyle: false,          //import style tags
            printContainer: true,        //grab outer container as well as the contents of the selector
            loadCSS: "/vendor/bootstrap/css/bootstrap.css",   //path to additional css file - us an array [] for multiple
            pageTitle: "",               //add title to print page
            removeInline: false,         //remove all inline styles from print elements
            printDelay: 333,             //variable print delay
            header: null,                //prefix to html
            formValues: true             //preserve input/form values
            });
        });

      });

            

//Funcion q muestra el modal de incripciones denegadas
      function showData(id,nmbre,apellidos)
        {
            var id = id;
            var nombre = nmbre;
            var apellido = apellidos;
            var selectedOption = $(this).children("option:selected").val();
            var textAreaRazones = $.trim($("razon").val());
           
            document.getElementById("nombre").value = nmbre + " " + apellidos; 
            var url = 'http://traductorescertificados/inscripcionesDeneg/' + id;
            // var url = 'http://traductorescertificados/inscripcionesDeneg/' + id + '/' + selectedOption + '/' +  textAreaRazones;
            $("#Form").attr('action', url);
        }

        function showAprobarData(id,nmbre,apellidos,carnet,colorPiel,profesion,sexo,direccion,provincia,municipio,tel_fijo,tel_cel,email,idioma,certificacion) 
        {
          // alert(id);
          // document.getElementById("ocultos").value = id;
          document.getElementById("nombrePlanilla").value = nmbre;
          document.getElementById("apellidos").value = apellidos;
          document.getElementById("CI").value = carnet;
          document.getElementById("colorP").value = colorPiel;
          document.getElementById("profesion").value = profesion;
          document.getElementById("sexo").value = sexo;
          document.getElementById("direccion").value = direccion;
          document.getElementById("provincia").value = provincia;
          document.getElementById("municipio").value = municipio;
          document.getElementById("telefono_fijo").value = tel_fijo;
          document.getElementById("telefono_celular").value = tel_cel;
          document.getElementById("correo").value = email;
          document.getElementById("idioma").value = idioma;
          document.getElementById("certificación").value = certificacion;
        }

        function formSubmit()
        {
          var oculto = document.getElementById("oculto").value;
          // alert(oculto);
          if (oculto == "") 
          {
            alert("Debe seleccionar un elemento de la lista de opciones");
            $('#incModal').click(function(e) {
              e.preventDefault();
              $($(this).attr('data-modal-id')).modal('show',{
                  onApprove : function() {
                      return false; //block the modal here
              }
              });
          });
          }
          else
          {
            $("#Form").submit();
          }
        }
        
  </script>
@endsection

@endsection
