@php
    if(!isset($title)){
        $title = '';
    }
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') . ' - ' . $title }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/'.$theme.'/app.css') }}">
</head>