<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  </head>
  <body class="app sidebar-mini rtl">
      <div id="app">
        <!-- Navbar-->
        @include('admin.layouts.partials.header')
        <!-- Sidebar menu-->
        @include('admin.layouts.partials.sidebar')
        <main class="app-content">
            @yield('content')
        </main>
      </div>
  </body>
</html>