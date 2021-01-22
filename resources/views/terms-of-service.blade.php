@extends('layouts.base')
@include('layouts.head')
@include('layouts.footer')
@section('content')
@component('components.navbar')
@endcomponent
@component('components.inner_head', ['title' => 'TERMS OF SERVICE'])
@endcomponent

<div class="section mt-5 pt-5">
    <div class="container">
        @include('components.CMTermsOfService');
    </div>
</div>

@endsection