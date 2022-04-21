<!DOCTYPE html>
<!-- 
  =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

beautify ignore:start
========================================================= -->

<html lang="en">

<head>
  @include('layouts._header')
  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('assets/css/page-auth.css') }}" />
</head>

<body>
  <!-- Content -->

  @yield('main-content')

  <!-- /Content -->

  @include('sweetalert::alert')
  <!-- Core JS -->
  @include('layouts._script')
</body>

</html>
