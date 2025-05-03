@extends('errors.error', [
    'errorCode' => '404',
    'icon' => 'bi-send-exclamation-fill',
    'message' => $exception->getMessage(),
])
