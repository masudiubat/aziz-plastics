<meta charset="utf-8" />

<title>@yield('title')</title>
<meta name="description" content="Page with empty content">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--begin::Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
<!--end::Fonts -->

<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles -->


<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->

<!--begin::Layout Skins(used by all pages) -->

<link href="{{ asset('assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
<!--end::Layout Skins -->

<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css')}}">

<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" />

<!-- Hotjar Tracking Code for keenthemes.com -->
<script>
    (function(h, o, t, j, a, r) {
        h.hj = h.hj || function() {
            (h.hj.q = h.hj.q || []).push(arguments)
        };
        h._hjSettings = {
            hjid: 1070954,
            hjsv: 6
        };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script');
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-37564768-1');
</script>

@stack('css')