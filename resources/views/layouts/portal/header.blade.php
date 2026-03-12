<!doctype html>
<html lang="{{ $page->locale }}" data-bs-theme="{{ $page->getThemeMode() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->getSiteTitle() }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ $page->getFaviconPath() }}">

    <!-- Theme -->
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="{{ $page->getThemePath() }}">
    @stack('styles')
    <script src="{{asset('themes/vendors/jquery.min.js')}}"></script>
    @include('layouts.portal.script_variables')

</head>
