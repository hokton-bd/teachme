@extends('layouts.base')
@include('layouts.head')
@include('layouts.footer')
@section('content')
@component('components.navbar')
@endcomponent
@component('components.inner_head', ['title' => 'PRIVACY POLICY'])
@endcomponent

<div class="section mt-5 pt-5">
    <div class="container">
        @include('components.CMPrivacyPolicy');
    </div>
</div>

@endsection