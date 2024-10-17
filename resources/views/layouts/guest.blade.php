<!doctype html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('templates')}}/assets/images/logos/favicon.png}}" />
  <link rel="stylesheet" href="{{ asset('templates')}}/src/assets/css/styles.min.css" />
</head>
<body>
  {{ $slot }}
  </section>
    <script src="{{ asset('templates')}}/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('templates')}}/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('templates')}}/assets/js/sidebarmenu.js"></script>
    <script src="{{ asset('templates')}}/assets/js/app.min.js"></script>
    <script src="{{ asset('templates')}}/assets/libs/simplebar/dist/simplebar.js"></script>
</body>
</html>