{{-- Starter newsletter. Customize this file in Cursor. The CMS does not edit it. --}}
@extends('layouts.newsletter')

@push('styles')
    @vite(['resources/css/newsletters/test-newsletter.css'])
@endpush

@section('content')
    <div class="newsletters-test-newsletter">
        @include('newsletters.partials.stage-1')
    </div>
@endsection
