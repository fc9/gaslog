<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}"/>

    <title>@yield('title') | {{env('APP_NAME')}}</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700;900&amp;family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <link href="{{asset('css/stage.style.css')}}" rel="stylesheet">
@yield('css')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-2108829-18"></script>
    <script>
        window.dataLayer = window.dataLayer || []

        gtag('js', new Date())
        gtag('config', 'UA-2108829-18')

        function gtag() {
            dataLayer.push(arguments)
        }
    </script>

</head>

<body id="concurso">

<div id="fb-root"></div>
<script src="https://connect.facebook.net/en_US/sdk.js" nonce="u0g2adiE"></script>
<script nonce="u0g2adiE">
    FB.init({
        appId: 429641184052945,
        status: true,
        xfbml: true,
        version: 'v8.0'
    });
    FB.AppEvents.logPageView();
</script>
<script src="https://apis.google.com/js/api:client.js"></script>

@yield('content')

<footer></footer>

@yield('scripts')
<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/stage.app.js')}}"></script>

</body>
</html>
