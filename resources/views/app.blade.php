<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BNTK</title>
        <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('lib/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('lib/css/nucleo-svg.css')}}" rel="stylesheet" />
   
    {{-- Use asset() helper for proper URL generation --}}
        <script src="{{ asset('dymo.js') }}"></script>

        @php 
        $dir = public_path() . '/assets';
        $cssfile = glob($dir.'/*.css');
        if($cssfile) {
            foreach($cssfile as $css) {
                // if (strpos($css, 'app-') === false) {
                //     continue;
                // }
                $css = explode('public/', $css)[1];

                echo "<link rel='stylesheet' href='" . asset($css) . "'>";
            }
        }
        @endphp

         <!-- CSS Files -->
         <link id="vuetify-theme-stylesheet" rel="stylesheet" />
        {{-- <link href="{{ asset('lib/css/argon-dashboard.css')}}" rel="stylesheet" /> --}}
    </head>
    <body>
        <div id="app"></div>
        @php 
        $jsfile = glob($dir.'/app-*.js');
        
        if($jsfile) {
            $app = explode('public/', $jsfile[0])[1];
            echo "<script type='module' src='" . asset($app) . "'></script>";
        } else {
            echo 'app js not found';
        }
        @endphp

        <!--   Core JS Files   -->
    <script src="{{ asset('lib/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('lib/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('lib/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('lib/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('lib/js/argon-dashboard.js')}}"></script>
    @stack('js');
    

    </body>
</html>
