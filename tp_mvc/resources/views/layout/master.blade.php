<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web App</title>

    <link rel="sass" href="/assets/assets/sass/app.scss">

</head>
<body>

@include('layout.navbar')

<div class="container">

    @yield('content')

</div>

@include('layout.footer')

@yield('script')

<script src="/js/app.js"></script>
</body>
</html>
