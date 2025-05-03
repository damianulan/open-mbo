@extends('errors.error', [
    'errorCode' => '401',
    'icon' => 'bi-shield-fill-exclamation',
    'message' => $exception->getMessage(),
])
