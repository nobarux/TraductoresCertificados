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
      <div class="col-lg-12  mx-auto">
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
                                    <th>Número</th>
                                    <th>Nombre</th>
                                    {{-- <th>Apellidos</th> --}}
                                    <th>Carnet</th>
                                    <th>Email</th>
                                    <th>Profesión</th>
                                    <th>Ciudad</th>
                                    <th>Tipo Certificación</th>
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
                                        <td>{{ $solicitudes->id }} </td> 
                                        <td>{{ $solicitudes->nombre. " " .$solicitudes->apellidos}}</td>
                                        {{-- <td>{{ $solicitudes->apellidos }} </td>  --}}
                                        <td>{{ $solicitudes->carnet }} </td> 
                                        <td><font color="blue"><u><a data-toggle="modal" onclick='showDataEmail("{{$solicitudes->id}}","{{$solicitudes->nombre}}","{{$solicitudes->apellidos}}","{{$solicitudes->email}}")' type="button" data-target="#showEmailModal" data-email="{{$solicitudes->email}}" target = container>{{ $solicitudes->email }} </a></u></font></td> 
                                        <td>{{ $solicitudes->listaprofesion($solicitudes->profesion)}}</td>
                                        <td>{{ $solicitudes->listaprovincias($solicitudes->provincia)}}</td>
                                        <td>{{ $solicitudes->listacertificacion($solicitudes->certificacion)}} </td> 
                                        <td>{{ $solicitudes->sexo }} </td>
                                        <td>{{ $solicitudes->telefono_fijo }} </td>
                                        <td>{{ $solicitudes->telefono_celular }} </td>
                                        {{-- <td>{{ $solicitudes->listaprovincias($solicitudes->provincia) }} </td>  --}}
                                        <td>{{ $solicitudes->listaidiomas($solicitudes->idioma)}} </td>
                                        <td>{{ $solicitudes->listaestados($solicitudes->estado)}} </td>
                                        <td data-order="{{ strtotime($solicitudes->created_at)}}" > {{ date('d-m-Y', strtotime($solicitudes->created_at)) }}</td>
                                        <td> 
                                          {{-- <button data-toggle="modal" onclick='showAprobarData("{{$solicitudes->id}}","{{$solicitudes->nombre}}",
                                          "{{$solicitudes->apellidos}}","{{$solicitudes->carnet}}","{{ $solicitudes->listacolor($solicitudes->colorP)}}",
                                          "{{ $solicitudes->listaprofesion($solicitudes->profesion)}}","{{$solicitudes->sexo}}",
                                          "{{ $solicitudes->listaprovincias($solicitudes->provincia)}}","{{ $solicitudes->listamunicipio($solicitudes->municipio)}}",
                                          "{{$solicitudes->telefono_fijo}}","{{$solicitudes->telefono_celular}}","{{$solicitudes->email}}",
                                          "{{ $solicitudes->listaidiomas($solicitudes->idioma)}}","{{ $solicitudes->listacertificacion($solicitudes->certificacion)}}","{{$solicitudes->direccion}}")' data-target="#showModal" class="btn btn-primary btn-sm">
                                            <i class="fa fa-folder-plus"></i> Aprobar admisión examen
                                          </button> --}}

                                          <button data-toggle="modal" type="button" data-id="{{$solicitudes->id}}" data-nombre="{{$solicitudes->nombre}}"
                                            data-apellidos="{{$solicitudes->apellidos}}" data-carnet="{{$solicitudes->carnet}}" data-colorpiel="{{$solicitudes->listacolor($solicitudes->colorP)}}" 
                                            data-profesion="{{$solicitudes->listaprofesion($solicitudes->profesion)}}" data-sexo="{{$solicitudes->sexo}}" data-direccion="{{$solicitudes->direccion}}"
                                            data-provincia="{{$solicitudes->listaprovincias($solicitudes->provincia)}}" data-municipio="{{$solicitudes->listamunicipio($solicitudes->municipio)}}" 
                                            data-tel_fijo="{{$solicitudes->telefono_fijo}}" data-tel_cel="{{$solicitudes->telefono_celular}}" data-email="{{$solicitudes->email}}"
                                            data-idioma="{{$solicitudes->listaidiomas($solicitudes->idioma)}}" data-certificacion="{{$solicitudes->listacertificacion($solicitudes->certificacion)}}" data-foto = "{{$solicitudes->file_foto}}"
                                            data-target="#showModal" class="btn btn-primary btn-sm">
                                              <i class="fa fa-folder-plus"></i> Aprobar admisión examen
                                            </button>

                                          {{-- <form method="POST"  action="/solicitudes/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                          </form> --}}
    
                                          {{-- <form method="POST"  action="/solicitudesPend/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">
                                              <i class="fa fa-stopwatch"></i>  Pendiente Calif.
                                            </button>
                                          </form> --}}
    
                                          <form method="POST"  action="/solicitudesAprob/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">
                                              <i class="fa fa-check"></i>  Aprobar Examen
                                            </button>
                                          </form>
    
                                          <form method="POST"  action="/solicitudesSusp/{{ $solicitudes->id }}" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" value="submit">
                                              <i class="fa fa-times-circle"></i>  Suspender Examen
                                            </button>
                                          </form>

                                            <button data-toggle="modal" onclick='showData("{{$solicitudes->id}}","{{$solicitudes->nombre}}","{{$solicitudes->apellidos}}")' data-target="#incModal" class="btn btn-primary btn-sm">
                                              <i class="fa fa-ban"></i>  Denegar inscripción
                                            </button>
                                        </td>
                                        <td style="text-align: center">
                                          {{-- <a href="{{ route('solicitudes.descFoto', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar foto</a>
                                          <a href="{{ route('solicitudes.descCarnet1', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar carnet anverso</a>
                                          <a href="{{ route('solicitudes.descCarnet2', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar carnet reverso</a>
                                          <a href="{{ route('solicitudes.descTit', $solicitudes->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Descargar título</a> 
                                          <a href="{{ route('solicitudes.descAnte', $solicitudes->id) }}" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar antecedentes</a> --}}
                                          {{-- foto --}}
                                          {{-- {{var_dump("/certificacion" . "/" . $solicitudes->file_antecedentes)}}; --}}
                                          @if(file_exists("/certificacion"  . "/" . $solicitudes->file_foto))
                                            @else
                                            <a download="foto" href="/certificacion/{{$solicitudes->file_foto}}"  class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar foto </a>
                                          @endif
                                          {{-- carnet 1  --}}
                                          @if(file_exists("/certificacion"  . "/" . $solicitudes->file_carnet1))
                                            @else
                                            <a download="carnet anverso" href="/certificacion/{{$solicitudes->file_carnet1}}"  class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar carnet anverso </a>
                                          @endif
                                         {{-- carnet 2 --}}
                                          @if(file_exists("/certificacion"  . "/" . $solicitudes->file_carnet2))
                                            @else
                                            <a download="carnet reverso" href="/certificacion/{{$solicitudes->file_carnet2}}"  class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar carnet reverso </a>
                                          @endif
                                          {{-- titulo  --}}
                                          @if(file_exists("/certificacion"  . "/" . $solicitudes->file_titulo))
                                            @else
                                            <a download="título" href="/certificacion/{{$solicitudes->file_titulo}}"  class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar título </a>
                                          @endif
                                          {{-- antecedentes  --}}
                                          @if($solicitudes->file_antecedentes == ""/*file_exists("/certificacion"  . "/" . "antecedentes.jpg")*/)
                                            @else 
                                            <a download="antecedentes" href="/certificacion/{{$solicitudes->file_antecedentes}}"  class="btn btn-success btn-sm"><i class="fa fa-download"></i> Descargar antecedentes </a>
                                          @endif
                                          
                                          
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
          @method('PATCH')
          @csrf

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">¿Esta seguro que desea denegar esta inscripción?</label>
            <input class="form-control" id="nombre" name="nombre" type="text" readonly>
            <input class="form-control" id="oculto" name="oculto" type="text" hidden>
            <input class="form-control" id="ocultoOpcionDenegar" name="ocultoOpcionDenegar" type="text" hidden>
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
        <h5 class="modal-title" id="showModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body" id="inscripcionModal">
        <form method="POST" action="" id="FormImprimir" >
          @method('PATCH')
          @csrf

          <div class="form-group">
            <h5 style="position: absolute; right: 20px">CERT-01</h5>
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
          <div id="test">
          <div class="form-group">
            <div class="col-8 col-sm-12" style="text-align: center;">
              <img src="" id="imagen" style="width: 200px; height: 200px; margin: 25px 0 20px;" class="rounded" alt="...">
            </div>
            <div class="col-8 col-sm-12">
              <label for="nombrePlanilla" class="col-form-label">Nombre(s)</label>
              <input class="form-control" id="nombrePlanilla" name="nombrePlanilla" type="text" readonly>
              <input class="form-control" id="ocultos" name="ocultos" type="text" hidden>
            </div>
            <div class="col-8 col-sm-12">
              <label for="apellidos" class="col-form-label">Apellidos</label>
              <input class="form-control" id="apellidos" name="apellidos" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="CI" class="col-form-label">Carnet de Identidad</label>
              <input class="form-control" id="CI" name="CI" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="colorP" class="col-form-label">Color de Piel</label>
              <input class="form-control" id="colorP" name="colorP" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="profesion" class="col-form-label">Profesión</label>
              <input class="form-control" id="profesion" name="profesion" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="sexo" class="col-form-label">Sexo</label>
              <input class="form-control" id="sexo" name="sexo" type="text" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="col-8 col-sm-12">
            <label for="message-text" class="col-form-label">Dirección</label>
            <input class="form-control" id="direccion" name="direccion" type="text" readonly>
            {{-- <textarea class="form-control" id="direccion" name="direccion" readonly></textarea> --}}
            </div>
          </div>

          <div class="form-group">
            <div class="col-8 col-sm-12">
              <label for="provincia" class="col-form-label">Provincia</label>
              <input class="form-control" id="provincia" name="provincia" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="municipio" class="col-form-label">Municipio</label>
              <input class="form-control" id="municipio" name="municipio" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="telefono_fijo" class="col-form-label">Teléfono Fijo</label>
              <input class="form-control" id="telefono_fijo" name="telefono_fijo" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="telefono_celular" class="col-form-label">Teléfono Celular</label>
              <input class="form-control" id="telefono_celular" name="telefono_celular" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="correo" class="col-form-label">Correo electrónico</label>
              <input class="form-control" id="correo" name="correo" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="idioma" class="col-form-label">Idioma</label>
              <input class="form-control" id="idioma" name="idioma" type="text" readonly>
            </div>
            <div class="col-8 col-sm-12">
              <label for="certificación" class="col-form-label">Certificación a Solicitar</label>
              <input class="form-control" id="certificación" name="certificación" type="text" readonly>
            </div>
          </div>
        </div>
          <div class="modal-footer">
            
            {{-- <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button> --}}
            <div class="form-group col-md-4" style="margin-right: 100px;">
              <label for="pasarela">Seleccioné la pasarela de pago <span class="text-danger">*</span></label>
              <select class="form-control" name="pasarela" id="pasarela" required>
                <option value="">Seleccioné una opción</option>
                <option value="Transfermóvil">Transfermóvil</option>
                <option value="Enzona">Enzona</option>
              </select>
          </div>

              <button type="submit" id="saveButton" name="" class="btn btn-primary"  onclick='sendData()'><i class="fa fa-check"></i> Aprobar </button>
              <button type="button" name="printButton" id="printButton" class="btn btn-primary" onclick="print()" ><i class="fa fa-print"></i> Imprimir </button>
      </div>

        </form>
        
      </div>
      </div>
    </div>

  </div>

</div>

{{-- Termino Modal para el imprimir cert --}}

{{-- Modal para mandar el correo al cliente --}}
<div class="modal fade bd-example-modal-lg" id="showEmailModal" tabindex="-1" role="dialog" aria-labelledby="showEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showEmailModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body" id="emailModal">
        <form method="GET" action="" id="FormSendEmail" >
          {{-- @method('PATCH') --}}
          @csrf

          <div class="form-group">
            <h5 style="position: absolute; right: 20px">CERT-01</h5>
            <br />

            {{-- <h3 class="text-center">
              Se enviará un correo a:
            </h3> --}}
          </div>
          <div id="test">
          <div class="form-group">
            <div class="col-8 col-sm-12">
              <label for="correo" class="col-form-label">Correo electrónico</label>
              <input class="form-control" id="correoEmail" name="correoEmail" type="text" readonly>
            </div>

            <div class="col-8 col-sm-12">
              <label for="nombreEmail" class="col-form-label">Nombre y Apellido</label>
              <input class="form-control" id="nombreEmail" name="nombreEmail" type="text" readonly>
              <input class="form-control" id="ocultos" name="ocultos" type="text" hidden>
            </div>
            
          </div>

          <div class="form-group">
            <div class="col-8 col-sm-12">
            <label for="message-text" class="col-form-label">Mensaje</label>
            {{-- <input class="form-control" id="direccion" name="direccion" type="text" readonly> --}}
            <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Escriba el contenido del correo aqui..."></textarea>
            </div>
          </div>

        </div>
          <div class="modal-footer">
            
              <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar </button>
              <button type="submit" id="saveButton" name="" class="btn btn-primary" data-dismiss="modal" onclick='sendMail()'><i class="fa fa-paper-plane"></i> Enviar </button>
              
        </form>
        
      </div>
      </div>
    </div>

  </div>

</div>
{{-- Termino Modal para mandar el correo al cliente  --}}



@section('dataTableJS')
<script src="js/print.js"></script>
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
          document.getElementById("ocultoOpcionDenegar").value = selectedOption;
          if (selectedOption == "Otros") {
            $("#textRazones").removeAttr('hidden');
          }
          else
          {
            $("#textRazones").attr("hidden",true);
            $("#razon").val('');
          }
          
        })

        $('#showModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        console.log(button);
        // let id = button.data('deleteid');
        let id = button.data('id');
        let nmbre = button.data('nombre');
        let apellidos = button.data('apellidos');
        let carnet = button.data('carnet');
        let colorPiel = button.data('colorpiel');
        let profesion = button.data('profesion');
        let sexo = button.data('sexo');
        let direccion = button.data('direccion');
        let provincia = button.data('provincia');
        let municipio = button.data('municipio');
        let tel_fijo = button.data('tel_fijo');
        let tel_cel = button.data('tel_cel');
        let email = button.data('email');
        let idioma = button.data('idioma');
        let certificacion = button.data('certificacion');
        let foto = button.data('foto');
        var modal = $(this)
        
          var imagModal = document.querySelector('#imagen');
          imagModal.setAttribute("src", "/certificacion/" + foto);

          document.getElementById("ocultos").value = id;
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
        })

        // $("#printButton").click(function(){
        //   // alert("aaaaa");
        //   $("#inscripcionModal").printThis({
        //     debug: false,                //show the iframe for debugging
        //     importCSS: true,             //import page CSS
        //     importStyle: false,          //import style tags
        //     printContainer: true,        //grab outer container as well as the contents of the selector
        //     loadCSS: "/vendor/bootstrap/css/bootstrap.css",   //path to additional css file - us an array [] for multiple
        //     pageTitle: "",               //add title to print page
        //     removeInline: false,         //remove all inline styles from print elements
        //     printDelay: 333,             //variable print delay
        //     header: null,                //prefix to html
        //     formValues: true             //preserve input/form values
        //     });
        // });

      });

            

      //Funcion q muestra el modal de incripciones denegadas
      function showData(id,nmbre,apellidos)
        {
            var id = id;
            var nombre = nmbre;
            var apellido = apellidos;
            var selectedOption = $(this).children("option:selected").val();
            var textAreaRazones = $.trim($("razon").val());
            document.getElementById("oculto").value = id; 
            document.getElementById("nombre").value = nmbre + " " + apellidos; 
            var url = 'http://traductorescertificados/inscripcionesDeneg/' + id;
            // var url = 'http://traductorescertificados/inscripcionesDeneg/' + id + '/' + selectedOption + '/' +  textAreaRazones;
            $("#Form").attr('action', url);
        }

//Funcion q muestra el modal de envio de correo electronico
      function showDataEmail(id,nmbre,apellidos,correo)
        {
            var id = id;
            var nombre = nmbre;
            var apellido = apellidos;
            var textAreaEmail = $.trim($("mensaje").val());
            document.getElementById("oculto").value = id; 
            document.getElementById("nombreEmail").value = nmbre + " " + apellidos; 
            document.getElementById("correoEmail").value = correo; 
        }

        function sendData()
        {
          var oculto = document.getElementById("ocultos").value;
          //alert(oculto);

            var url = 'http://traductorescertificados/solicitudesInscr/' + oculto;
            // var url = 'http://traductorescertificados/inscripcionesDeneg/' + id + '/' + selectedOption + '/' +  textAreaRazones;
            if ($('#pasarela').val().trim() === '') {
              alert('Debe seleccionar una pasarela de pago')
            }
            else
            {
              $("#FormImprimir").attr('action', url);
              $("#FormImprimir").submit();
            }
            
        }

        function formSubmit()
        {
          var valorSeleccionadoDeneg = document.getElementById("ocultoOpcionDenegar").value;
          var idOculto = document.getElementById("oculto").value;
          // alert(idOculto);
          if (valorSeleccionadoDeneg == "") 
          {
            alert("Debe seleccionar un elemento de la lista de opciones");
            $('#incModal').click(function(e) {
              e.preventDefault();
              $($(this).attr('data-moqdal-id')).modal('show',{
                  onApprove : function() {
                      return false; //block the modal here
              }
              });
          });
          }
          else
          {
            var url = 'http://traductorescertificados/solicitudesDenegMensaje/' + idOculto;
            $("#Form").attr('action', url);
            $("#Form").submit();
          }
        }

        function sendMail()
        {
          var idOculto = document.getElementById("oculto").value;
          var email = document.getElementById('correoEmail').value;
          var cuerpoCorreo = document.getElementById('mensaje').value;
          //Le envio al controlador la url con el email al cual voy a enviar y el cuerpo del correo
          var url = 'http://traductorescertificados/enviarCor/enviar';
          // var url = 'http://traductorescertificados/enviarCor/enviar/' + email + '/' + cuerpoCorreo;
            $("#FormSendEmail").attr('action', url);
            $("#FormSendEmail").submit();
          // alert(email);
        }

        //Imprimir el modal 
        // document.getElementById("printButton").addEventListener("click", print);

        function print() {
          printJS({
            printable: "inscripcionModal",
            header: null,
            type: "html",
            documentTitle: '',
            style: "#test {position: absolute;top: 50%;left: 50%;margin: 100px 0 0 -250px;}",
            css: "/css/app.css",
            ignoreElements: ["printButton","saveButton"],
            targetStyles: ['*'],
            // style: '@page {size: A4}',
            scanStyles: false,
            honorMarginPadding: true,
          });
          
        }
        
  </script>
@endsection

@endsection
