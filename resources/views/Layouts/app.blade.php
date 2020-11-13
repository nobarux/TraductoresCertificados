<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
  <title>Sistema de Gestión para Traductores Certificados</title>

  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/vendor/jQueryDT/css/bootstrapDT.min.css" rel="stylesheet" type="text/css">
  <link href="/vendor/jQueryDT/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="/vendor/jQueryDT/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  
  <!-- Scripts -->

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{asset('js/bootstrap.js')}}"> </script>
  <script src="{{ asset('js/printThis.js') }}"></script>



  

  <!-- Custom styles for this template -->
  {{-- <link href="css/clean-blog.min.css" rel="stylesheet"> --}}
  <link href="/css/app.css" rel="stylesheet">


</head>

<body>
<div id="app">
  @if (!\Request::is('login') && !\Request::is('register'))
  {{-- Sirve para incluir elementos de otra vista. En este caso es para incluir un navbar personalizado --}}
  @include('partialViews.navbar')    
  @endif
   
  {{-- Sirve para decir q todo formulario q tenga esta etiqueta 'content' tenga todos los elementos de esta pagina. --}}
  @yield('content')
 
  {{-- <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script> --}}
</div>
</body>
@include('partialViews.footer')
</html>


<script src="/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/admin/scripts.js"></script>
{{-- <script src="/js/printThis.js"></script> --}}
<script src="/js/jQueryDT/js/dataTables.bootstrap4.js"></script>
<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/js/admin/demo/datatables-demo.js"></script>


@yield('jsModalDelete')
@yield('scriptNombreUpload')
@yield('dataTableJS')


