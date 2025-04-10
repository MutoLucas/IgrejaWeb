@extends('layouts.default')

@section('title', 'IgrejaWeb - Cadastro')

@section('content')

<div class="container mt-5 mb-3 shadow" style="max-width: 80%">
    <h1>Edição de Perfil</h1>
    <div class="container rounded p-3">
        <form action="{{ route('edit.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.cadastro.forms.form_complementar_user')
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-primary">
                    Editar
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
