<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}"/>

    <title>@yield('title') | {{env('APP_NAME')}}</title>

    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700;900&amp;family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css?ver=5.5" rel='stylesheet'/>
    <link href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet">
    <link href="{{asset('css/stage.style.css')}}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-2108829-18"></script>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || []

        gtag('js', new Date())
        gtag('config', 'UA-2108829-18')

        function gtag() {
            dataLayer.push(arguments)
        }
    </script>
</head>

<body id="pesquisa">

<!--<script async defer src="https://connect.facebook.net/en_US/all.js"></script> -->
<script async defer src="https://apis.google.com/js/api:client.js"></script>

@include('stage.includes.parts.header')
<main class="pt-18">
    @yield('content')
</main>
@include('stage.includes.parts.footer')

<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/stage.app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src='https://unpkg.com/filepond/dist/filepond.min.js?ver=1'></script>
<script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js?ver=1'></script>
<script src='https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js?ver=1'></script>
<script src="{{ asset('js/vendor.app.js') }}"></script>
</body>
</html>
