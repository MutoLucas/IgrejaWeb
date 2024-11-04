@extends('layouts.default')

@section('title', 'Recuperar Senha')

@section('content')

<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-sm border-0 p-4 rounded-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4 text-primary">Recuperar Senha</h3>

        <form action="{{ route('email.novaSenha', ['email' => $email]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="novaSenha" class="form-label fw-semibold">Nova Senha</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-envelope-fill text-primary"></i>
                    </span>
                    <input type="password" class="form-control border-start-0" id="senha" name="password" placeholder="Senha *******" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="verificarSenha" class="form-label fw-semibold">Confirmar Senha</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-envelope-fill text-primary"></i>
                    </span>
                    <input type="password" class="form-control border-start-0" id="confirmSenha" placeholder="Confirmar Senha" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3" id="submitBtn" disabled>Modificar Senha</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const senha = document.getElementById('senha');
        const confirmSenha = document.getElementById('confirmSenha');
        const submitBtn = document.getElementById('submitBtn');

        function checkPasswords() {
            if (senha.value && confirmSenha.value && senha.value === confirmSenha.value) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        senha.addEventListener('input', checkPasswords);
        confirmSenha.addEventListener('input', checkPasswords);
    });
</script>

@endsection
