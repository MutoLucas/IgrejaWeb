@extends('layouts.default')

@section('title', 'Recuperar Senha')

@section('content')

<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-sm border-0 p-4 rounded-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4 text-primary">Recuperar Senha</h3>

        <form action="{{ route('email.verifySendEmail') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-envelope-fill text-primary"></i>
                    </span>
                    <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="Email@example.com" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Enviar</button>
        </form>
    </div>
</div>

@endsection
