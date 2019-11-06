<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Web Application Designed by Shrestsav">
  <meta name="author" content="{{env('DEVELOPED_BY','ShreStsaV')}}">
  <title>{{env('APP_NAME','System')}}</title>
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{env('APP_URL')}}" />
  <!-- Favicon -->
  <link rel="icon" href="{{asset('argon')}}/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('argon')}}/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="{{asset('argon')}}/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('argon')}}/css/argon.min9f1e.css?v=1.1.0" type="text/css">
</head>

<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    @yield('content')
  </div>


  <!-- Core -->
  <script src="{{asset('argon')}}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{asset('argon')}}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('argon')}}/vendor/js-cookie/js.cookie.js"></script>
  <script src="{{asset('argon')}}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="{{asset('argon')}}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="{{asset('argon')}}/js/argon.min9f1e.js?v=1.1.0"></script>
</body>
</html>