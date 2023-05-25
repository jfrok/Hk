<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Hk') }}</title>
        <link rel="manifest" href="/manifest.json">
        <!-- Chrome for Android theme color -->
        <meta name="theme-color" content="#000000">

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="application-name" content="PWA">
        <link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

        <!-- Add to homescreen for Safari on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="PWA">
        <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

        <link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

        <!-- Tile for Win8 -->
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">
        <link rel="shortcut icon" href="assets/img/favicon.png">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">
{{--        <link rel="stylesheet" href="{{asset('assets/plugins/icons/flags/flags.css')}}">--}}
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
{{--        <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">--}}
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

{{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vuetify@3.2.1/dist/vuetify.min.css">--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--        <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">--}}
        <!-- Scripts -->
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>


    <body>

        @inertia
{{--        <div class="card">Testing</div>--}}

{{--        <div class="custom-context-menu">--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="#"> Download </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="#"> Edit </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="#"> Duplicate </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="#"> More Info </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
        <!-- Vue  -->
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/feather.min.js')}}"></script>
{{--        <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>--}}
        <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
{{--        <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>--}}
{{--        <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>--}}
{{--        <script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>--}}
{{--        <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js"></script>--}}
        <!-- CDNJS :: Sortable (https://cdnjs.com/) -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
{{--        <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>--}}
        <script src="{{asset('assets/js/script.js')}}"></script>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--        <script src="https://cdn.jsdelivr.net/npm/vuetify@3.2.1/dist/vuetify.min.js"></script>--}}
        <script>
            const card = document.querySelector(".card");
            const customContextMenu = document.querySelector(".custom-context-menu");

            card.addEventListener("contextmenu", (e) => {
                e.preventDefault();
                let topPosition = e.clientY;
                let leftPosition = e.clientX;
                customContextMenu.classList.add("active");

                customContextMenu.style.left = leftPosition + "px";
                customContextMenu.style.top = topPosition + "px";
            });

            window.addEventListener("click", () => {
                customContextMenu.classList.remove("active");
            });



        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>
