<div class="row mb-3">
    <div class="col-sm">
        <label for="Email" class="form-label">Email address</label>
        <input type="email" class="form-control border-primary" id="email" name="email" aria-describedby="emailHelp" required>
        <div id="emailHelp" class="form-text">Nós nunca iremos compartilhar seu e-mail.</div>
    </div>

    <div class="col-sm">
        <label for="password" class="form-label">Senha</label>
        <div class="input-group">
            <input type="password" class="form-control border-primary" id="password" name="password" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                Mostrar
            </button>
        </div>
    </div>

    <div class="col-sm">
        <label for="apelido" class="form-label">Apelido</label>
        <input type="text" class="form-control border-primary" id="apelido" name="apelido" maxlength="15">
    </div>
</div>

<script>
    const senha = document.getElementById('password');
    const btnShowSenha = document.getElementById('togglePassword');

    btnShowSenha.onclick = () => {
        if (senha.type === 'password') {
            senha.type = 'text';
            btnShowSenha.textContent = 'Esconder';
        } else {
            senha.type = 'password';
            btnShowSenha.textContent = 'Mostrar';
        }
    };

</script>

<div class="row mb-3">
    <div class="col-sm">
        <label for="name" class="form-label">Nome Completo</label>
        <input type="text" class="form-control border-primary" id="nome" name="nome" required>
    </div>

    <div class="col-sm">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control border-primary" id="cpf" name="cpf" maxlength="14" required>
    </div>

    <div class="col-sm">
        <label for="cpf" class="form-label">RG</label>
        <input type="text" class="form-control border-primary" id="rg" name="rg" required>
    </div>

    <script>
        const cpf = document.getElementById('cpf');
        const rg = document.getElementById('rg');

        cpf.addEventListener('input', () => {
            let value = cpf.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            cpf.value = value;
        });

        rg.addEventListener('input', () => {
            let value = rg.value.replace(/\D/g, '');
            value = value.replace(/(\d{2})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            rg.value = value;
        });

    </script>


</div>

<div class="row mb-3">
    <div class="col-sm">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control border-primary" id="foto" name="foto">
    </div>

    <div class="col-sm">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control border-primary" id="telefone" name="telefone" required>
    </div>

    <div class="col-sm">
        <label class="form-label" for="sexo">Sexo</label>
        <select class="form-select border-primary" id="sexo" name="sexo" required>
            <option selected>Escolha...</option>
            <option value="M">Masculino</option>
            <option value="F">Femino</option>
        </select>
    </div>

    <script>
        const telefone = document.getElementById('telefone');

        telefone.addEventListener('input', () => {
            let value = telefone.value.replace(/\D/g, '');
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');

            telefone.value = value;
        });

    </script>
</div>

<div class="g-recaptcha mb-2" data-sitekey="6LdGCxkqAAAAAMQ627S_gX0E4PVD2kd7sV9Bzxxy"></div>


<button class="btn btn-primary" onclick="return valida()">
    Cadastrar
</button>

<script>
    function valida(){
        if(grecaptcha.getResponse() == ""){
            alert("VocÊ precisa marcar o reCaptcha");
            return false;
        }
    }
</script>




