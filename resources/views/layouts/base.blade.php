<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @stack('meta')

  <title>@yield('title') | {{ config('app.name') }}</title>

  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  @stack('styles')
</head>

<body class="@yield('body-class')">
  @yield('body')

  <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
  @stack('scripts')
</body>

</html>
