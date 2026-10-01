@php
    $status = isset($exception) && $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
        ? $exception->getStatusCode()
        : 400;
    $errorPage = \App\Support\HttpErrorPage::forStatus($status);
@endphp

@extends('errors.layout')
