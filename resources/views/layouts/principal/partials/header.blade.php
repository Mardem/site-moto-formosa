<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Moto Formosa')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="capacete, vermelho">

    <meta property="og:title" content="@yield('title', 'Moto Formosa')" />
    <meta property="og:description" content="@yield('meta-description')" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:site_name" content="Moto Formosa" />
    <meta name="theme-color" content="#ff2b33" />
    <meta name="msapplication-TileColor" content="#ff2b33" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic,300italic,300&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('commerce/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/zabuto_calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/ion.rangeSlider.skinFlat.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('commerce/css/media.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        ul.pager li.active span {
            border-radius: 30px;
            background: #c0c4d7;
            color: #fff;
            padding: 1px 12px;
        }
    </style>
    @stack('css')
</head>

<body>

