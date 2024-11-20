@extends('layouts.default')

@section('title', 'IgrejaWeb - Cadastro')

@section('content')

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
