<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Dynamic Title & Meta -->
    <title>{{ config('app.name') }} - @yield('title', config('app.name'))  </title>
    <meta name="description" content="@yield('meta_description', 'Welcome to ' . config('app.name') . '. We offer quality products and services tailored for you.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ecommerce, coupons, online shopping, deals, ' . config('app.name'))">
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta name="google" content="notranslate">
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
        <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    @stack('styles')
</head>
<body>
       <header>
        <x-navbar />
    </header>

  <main class="container py-4">
        @yield('content')
    </main>

    <footer>
        <x-footer />
    </footer>
    @stack('scripts')
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
