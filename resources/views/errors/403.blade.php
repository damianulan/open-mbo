@extends('errors.error', [
    'errorCode' => '403',
    'icon' => 'bi-shield-fill-exclamation',
    'message' => $exception->getMessage(),
])
