<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta name="description" content="{{ Helper::GeneralSiteSettings("site_desc_".@Helper::currentLanguage()->code) }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
<link rel="apple-touch-icon" href="{{ asset('assets/dashboard/images/logo.png') }}">
<meta name="apple-mobile-web-app-title" content="Smartend">
<base href="{{ route("adminHome") }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="mobile-web-app-capable" content="yes">
<link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/dashboard/images/logo.png') }}">
@stack('before-styles')
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/animate.css/animate.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/animate.css/animate.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/glyphicons/glyphicons.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/font-awesome/css/font-awesome.min.css') }}"
      type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/material-design-icons/material-design-icons.css') }}"
      type="text/css"/>

<link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap/dist/css/bootstrap.min.css') }}"
      type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/font.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/topic.css') }}" type="text/css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/css/myfile-uploader.css') }}" type="text/css"/>
<style>
    .select2-container {
        width: 100% !important;
    }
    .myflex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

</style>
@if( @Helper::currentLanguage()->direction=="rtl")
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap-rtl/dist/bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.rtl.css') }}">
@endif
@stack('after-styles')
