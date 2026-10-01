@php
    $status = isset($exception) && $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
        ? $exception->getStatusCode()
        : 500;
    $errorPage = \App\Support\HttpErrorPage::forStatus($status);
@endphp

@extends('errors.layout')
