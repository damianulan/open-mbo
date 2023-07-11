<!doctype html>
<html lang="{{ $page->locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->sitename . ' - ' . $page->title }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('themes/'.$page->theme.'/images/resources/favicon.ico') }}">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/'.$page->theme.'/app.css') }}">
    <script src="{{asset('themes/vendors/jquery.min.js')}}"></script>
    @include('layouts.portal.scripts')

</head>
