<!doctype html>
<html>
    <head>
        <!-- STYLES -->
        <link rel="stylesheet" type="text/css" href="{{asset('frontend_assets/style/normalize.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('frontend_assets/style/main.css')}}" />
        
        <!-- SCRIPTS -->
        <script type="text/javascript" src="{{asset('frontend_assets/script/jquery.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend_assets/script/purl.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend_assets/script/jquery.slides.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend_assets/script/frontend-engine.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend_assets/script/main.js')}}"></script>
    </head>
    <body>
        <div id="urls" style="display:none">
            <div id="handler">{{url()}}</div>
            <div id="template">{{asset('frontend_assets/html/template.html')}}</div>
            <div id="assets">{{asset('frontend_assets')}}</div>
        </div>
        <div id="body"></div>
    </body>
</html>
