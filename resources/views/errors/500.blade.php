@extends('errors.error', [
    'errorCode' => '500',
    'icon' => 'bi-plug-fill',
    'message' => $exception->getMessage(),
])
