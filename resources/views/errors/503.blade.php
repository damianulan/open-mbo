@extends('errors.error', [
    'errorCode' => '503',
    'icon' => 'bi-plug-fill',
    'message' => $exception->getMessage(),
])
