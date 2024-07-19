@extends('layouts.default')

@section('title', 'home - VerboWeb')

@section('page_title', 'Home VerboWeb')

@section('content')
@if(Session::get('success'))
<div class="alert alert-success text-center p-2">
    {{ Session::get('success') }}
</div>
@endif

@if(Session::get('error'))
<div class="alert alert-danger text-center p-2">
    {{ Session::get('error') }}
</div>
@endif

@endsection
