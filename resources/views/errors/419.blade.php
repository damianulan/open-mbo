@extends('errors.error', [
    'errorCode' => '404',
    'icon' => 'shield-fill-exclamation',
    'message' => $exception->getMessage(),
])
