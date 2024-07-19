@extends('layouts.default')

@section('title', 'VerboWeb - Cadastro')

@section('content')

@if(Session::get('error'))
<div class="alert alert-danger text-center p-2">
    {{ Session::get('error') }}
</div>
@endif

<div class="container mt-5 shadow" style="max-width: 80%">
    <h1>Cadastro</h1>
    <div class="container rounded p-3">
        <form action="{{ route('cadastro.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.cadastro.forms.form_cadastro_user')
        </form>
    </div>
</div>

@endsection
