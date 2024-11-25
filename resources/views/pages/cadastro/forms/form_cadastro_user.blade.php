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
        <input type="text" class="form-control border-primary" id="apelido" name="apelido" maxlength="15" required>
    </div>

    <div class="col-sm">
        <label for="data_nasci" class="form-label">Data de nascimento</label>
        <input type="date" class="form-control border-primary" id="data_nasci" name="data_nasci" required>
        <div id="dataHelp" class="form-text" style="display: none">Menor de idade</div>
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
        <div id="cpfHelp" class="form-text" style="display: none">CPF inválido</div>
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

<div class="g-recaptcha mb-2" data-sitekey="{{ config('globals.recaptchaCadastro1') }}"></div>


<button id="btn-cadastrar" class="btn btn-primary" onclick="return valida()" disabled>
    Cadastrar
</button>

<script>
    const dataInput = document.getElementById('data_nasci')
    const btn = document.getElementById('btn-cadastrar')
    const cpfInput = document.getElementById('cpf')

    function calcularIdade(dataNascimento) {
        const hoje = new Date();
        const nascimento = new Date(dataNascimento);
        let idade = hoje.getFullYear() - nascimento.getFullYear();
        const mes = hoje.getMonth() - nascimento.getMonth();

        if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
            idade--;
        }

        return idade;
    }

    dataInput.addEventListener('input', function() {
        const dataNascimento = dataInput.value;
        const idade = calcularIdade(dataNascimento);

        if (dataNascimento === '') {
            document.getElementById('dataHelp').style.display = 'none';
            btn.disabled = true;
        } else {
            if (idade >= 18 ) {
                btn.disabled = false;
                document.getElementById('dataHelp').style.display = 'none';
            } else {
                btn.disabled = true;
                document.getElementById('dataHelp').style.display = 'block';
            }
        }

    });

    cpfInput.addEventListener('input', function(){
        const cpf = cpfInput.value

        function validarCPF(cpf) {
            // Remove caracteres não numéricos
            cpf = cpf.replace(/[^\d]+/g, '');

            // Verifica se o CPF possui 11 dígitos ou se é uma sequência repetida (ex: 000.000.000-00)
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                return false;
            }

            let soma = 0;
            let resto;

            // Calcula o primeiro dígito verificador
            for (let i = 1; i <= 9; i++) {
                soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            }
            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) {
                resto = 0;
            }
            if (resto !== parseInt(cpf.substring(9, 10))) {
                return false;
            }

            soma = 0;

            // Calcula o segundo dígito verificador
            for (let i = 1; i <= 10; i++) {
                soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            }
            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) {
                resto = 0;
            }
            if (resto !== parseInt(cpf.substring(10, 11))) {
                return false;
            }

            return true;
        }

        const cpfValidado = validarCPF(cpf)
        //console.log(cpfValidado)

        if(cpfValidado === true){
            btn.disabled = false;
            document.getElementById('cpfHelp').style.display = 'none';
        }else{
            btn.disabled = true;
            document.getElementById('cpfHelp').style.display = 'block';
        }
    });


</script>

<script>
    function valida() {
        if (grecaptcha.getResponse() == "") {
            alert("VocÊ precisa marcar o reCaptcha");
            return false;
        }
    }

</script>
