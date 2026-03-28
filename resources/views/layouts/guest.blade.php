<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
          <script src="https://cdn.tailwindcss.com"></script>
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" />
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>

    <script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('public/admin_assets/vendors/general/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('public/admin_assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/app/custom/general/components/extended/toastr.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif


        @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
        @endif


        @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
        @endif


        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @endif

        window.addEventListener('toastr', event  => {
                alertMsg(event.detail.msg,event.detail.type);
        });

        function alertMsg($msg,$type){
                switch($type){
            case 'success':
                toastr.success($msg);
                break;
            case 'info':
                toastr.info($msg);
                break;
            case 'warning':
                toastr.warning($msg);
                break;
            case 'error':
                toastr.error($msg);
                break;
        }
        }
    </script>
</html>
