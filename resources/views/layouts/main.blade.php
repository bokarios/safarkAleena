<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>سفرك علينا</title>
      <!-- Favicon -->
      {{-- <link href="" rel="icon" type="image/png"> --}}
      <!-- Icons -->
      <link href="{{asset('admins/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
      <link href="{{asset('admins/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
      <!-- Animation CSS -->
      <link rel="stylesheet" href="{{asset('css/animate.css')}}">
      <!-- Argon CSS -->
      <link type="text/css" href="{{asset('admins/css/argon.css')}}" rel="stylesheet">
      <link type="text/css" href="{{asset('css/app.css')}}" rel="stylesheet">
      <!-- Argon Scripts -->
      <!-- Core -->
      <script src="{{asset('admins/vendor/jquery/dist/jquery.min.js')}}"></script>
      <script src="{{asset('admins/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
      <!-- Optional JS -->
      <script src="{{asset('admins/vendor/chart.js/dist/Chart.min.js')}}"></script>
      <script src="{{asset('admins/vendor/chart.js/dist/Chart.extension.js')}}"></script>
      <!-- Argon JS -->
      <script src="{{asset('admins/js/argon.js')}}"></script>
  </head>
  <style>
    .table-responsive {
      direction: rtl !important;
    }
  </style>
<body>
  @include('inc.messages')
  @yield('content')

  <!-- Custom JS -->
  <script src="{{asset('js/custom.js')}}"></script>
  <script>
    $(document).ready(function(){
      $('#myTab a[href="#{{old('tab')}}"]').tab('show')
    })
  </script>
 
</body>

</html>