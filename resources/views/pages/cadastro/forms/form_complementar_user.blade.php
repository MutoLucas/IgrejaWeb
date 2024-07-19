<div class="accordion accordion-flush">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Dados Pessoais
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse mt-3 p-3" data-bs-parent="#accordionFlushExample">
            <div class="row mb-3">
                <div class="col-sm">
                    <label for="Email" class="form-label">Email address</label>
                    <input type="email" value="{{ $user->email }}" class="form-control border-primary" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Nós nunca iremos compartilhar seu e-mail.</div>
                </div>

                <div class="col-sm">
                    <label for="password" class="form-label">Senha</label>
                    <div class="input-group">
                        <input disabled type="password" class="form-control border-primary" id="password" name="password">
                        <button disabled class="btn btn-outline-secondary" type="button" id="togglePassword">
                            Mostrar
                        </button>
                    </div>
                </div>

                <div class="col-sm">
                    <label for="apelido" class="form-label">Apelido</label>
                    <input type="text" value="{{ $user->apelido }}" class="form-control border-primary" id="apelido" name="apelido" maxlength="15">
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
                    <input type="text" value="{{ $user->dado->nome }}" class="form-control border-primary" id="nome" name="nome">
                </div>

                <div class="col-sm">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" value="{{ $user->dado->cpf }}" class="form-control border-primary" id="cpf" name="cpf" maxlength="14">
                </div>

                <div class="col-sm">
                    <label for="cpf" class="form-label">RG</label>
                    <input type="text" value="{{ $user->dado->rg }}" class="form-control border-primary" id="rg" name="rg">
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
                    <input type="text" value="{{ $user->dado->telefone }}" class="form-control border-primary" id="telefone" name="telefone">
                </div>

                <div class="col-sm">
                    <label class="form-label" for="sexo">Sexo</label>
                    <select class="form-select border-primary" id="sexo" name="sexo">
                        <option>Escolha...</option>
                        <option value="M" @if (isset($user->dado->sexo)) @selected($user->dado->sexo == 'M') @endif>Masculino</option>
                        <option value="F" @if (isset($user->dado->sexo)) @selected($user->dado->sexo == 'F') @endif>Femino</option>
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
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Naturalidade
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="container row p-3">
                <div class="col-sm p-3">
                    <div class="mb-3">
                        <label for="naturalidade" class="form-label">Naturalidade</label>
                        <input type="text" value="{{ $user->dado->naturalidade }}" class="form-control border-primary" name="naturalidade">
                    </div>

                    <div>
                        <label for="uf_naturalidade" class="form-label">UF de Naturalidade</label>
                        <input type="text" value="{{ $user->dado->uf_naturalidade }}" class="form-control border-primary" name="uf_naturalidade">
                    </div>
                </div>

                <div class="col-sm p-3">
                    <div class="mb-3">
                        <label for="data_nasci" class="form-label">Data de Nascimento</label>
                        <input type="date" value="{{ $user->dado->data_nasci }}" class="form-control border-primary" name="data_nasci">
                    </div>

                    <div class="">
                        <label class="form-label" for="estado civil">Estado Civil</label>
                        <select class="form-select border-primary" name="estado_civil">
                            <option>Escolha...</option>
                            <option value="solteiro" @if (isset($user->dado->estado_civil)) @selected($user->dado->estado_civil == 'solteiro') @endif>Solteiro</option>
                            <option value="casado" @if (isset($user->dado->estado_civil)) @selected($user->dado->estado_civil == 'casado') @endif>Casado</option>
                            <option value="viuvo" @if (isset($user->dado->estado_civil)) @selected($user->dado->estado_civil == 'viuvo') @endif>Viuvo</option>
                            <option value="divorciado" @if (isset($user->dado->estado_civil)) @selected($user->dado->estado_civil == 'divorciado') @endif>Divorciado</option>
                            <option value="separado" @if (isset($user->dado->estado_civil)) @selected($user->dado->estado_civil == 'separado') @endif>Separado</option>
                            <option value="uniap_estavel" @if (isset($user->dado->estado_civil)) @selected($user->dado->estado_civil == 'uniao_estavel') @endif>União Estavel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseTwo">
                Endereço
            </button>
        </h2>
        <div id="flush-collapseTree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="container p-3">
                <div class="container row mb-3">
                    <div class="col-sm">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" @if (isset($user->endereco->cidade))
                        value="{{ $user->endereco->cidade }}"
                        @endif class="form-control border-primary" name="cidade">
                    </div>

                    <div class="col-sm">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" @if (isset($user->endereco->endereco))
                        value="{{ $user->endereco->endereco }}"
                        @endif class="form-control border-primary" name="endereco">
                    </div>
                </div>

                <div class="container row">
                    <div class="col-sm">
                        <label for="uf" class="form-label">UF - Estado</label>
                        <input type="text" @if (isset($user->endereco->uf))
                        value="{{ $user->endereco->uf }}"
                        @endif class="form-control border-primary" name="uf">
                    </div>

                    <div class="col-sm">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" @if (isset($user->endereco->bairro))
                        value="{{ $user->endereco->bairro }}"
                        @endif class="form-control border-primary" name="bairro">
                    </div>

                    <div class="col-sm">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" @if (isset($user->endereco->complemento))
                        value="{{ $user->endereco->complemento }}"
                        @endif class="form-control border-primary" name="complemento">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseTwo">
                Devoção
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="container p-3">
                <div class="container row mb-3">
                    <div class="col-sm">
                        <label for="data_novo_nasci" class="form-label">Data de novo Nascimento</label>
                        <input type="date" @if (isset($user->devocao->data_novo_nasci))
                        value="{{ $user->devocao->data_novo_nasci }}"
                        @endif class="form-control border-primary" name="data_novo_nasci">
                    </div>

                    <div class="col-sm">
                        <label class="form-label" for="rhema">Estado Rhema</label>
                        <select class="form-select border-primary" name="rhema">
                            <option>Escolha...</option>
                            <option value="sim" @if (isset($user->devocao->rhema)) @selected($user->devocao->rhema == 'sim') @endif>Finalizado</option>
                            <option value="nao" @if (isset($user->devocao->rhema)) @selected($user->devocao->rhema == 'nao') @endif>Não Fiz</option>
                            <option value="cursando" @if (isset($user->devocao->rhema)) @selected($user->devocao->rhema == 'cursando') @endif>Cursando</option>
                        </select>
                    </div>
                </div>

                <div class="container row">
                    <div class="col-sm">
                        <label class="form-label" for="batismo_aguas">Batismo nas aguas</label>
                        <select class="form-select border-primary" name="batismo_aguas">
                            <option>Escolha...</option>
                            <option value="sim" @if (isset($user->devocao->batismo_aguas)) @selected($user->devocao->batismo_aguas == 'sim') @endif>Fui batizado nas aguas</option>
                            <option value="nao" @if (isset($user->devocao->batismo_aguas)) @selected($user->devocao->batismo_aguas == 'nao') @endif>Não fui batizado nas aguas</option>
                        </select>
                    </div>

                    <div class="col-sm">
                        <label class="form-label" for="tipo_batismo_aguas">Tipo de batismo nas aguas</label>
                        <select class="form-select border-primary" name="tipo_batismo_aguas">
                            <option>Escolha...</option>
                            <option value="imersao" @if (isset($user->devocao->tipo_batismo_aguas)) @selected($user->devocao->tipo_batismo_aguas == 'imersao') @endif>Fui batizado por Imersão</option>
                            <option value="Aspersão" @if (isset($user->devocao->tipo_batismo_aguas)) @selected($user->devocao->tipo_batismo_aguas == 'aspersao') @endif>Fui batizado por Aspersão</option>
                        </select>
                    </div>

                    <div class="col-sm">
                        <label class="form-label" for="batismo_espirito">Batismo no Espirito Santo</label>
                        <select class="form-select border-primary" name="batismo_espirito">
                            <option>Escolha...</option>
                            <option value="sim" @if (isset($user->devocao->batismo_espirito)) @selected($user->devocao->batismo_espirito == 'sim') @endif>Fui batizado no Espirito Santo</option>
                            <option value="nao" @if (isset($user->devocao->batismo_espirito)) @selected($user->devocao->batismo_espirito == 'nao') @endif>Não fui batizado no Espirito Santo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseTwo">
                Escolaridade
            </button>
        </h2>
        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="container p-3">
                <div class="container row">
                    <div class="col-sm">
                        <label for="grau_instrucao" class="form-label">Grau de Instrução</label>
                        <select class="form-select border-primary" name="grau_instrucao">
                            <option>Escolha...</option>
                            <option value="f_i" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'f_i') @endif>Fundamental Incompleto</option>
                            <option value="f_c" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'f_c') @endif>Fundamental Completo</option>
                            <option value="m_i" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'm_i') @endif>Ensino Médio Incompleto</option>
                            <option value="m_c" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'm_c') @endif>Ensino Médio Completo</option>
                            <option value="s_i" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 's_i') @endif>Ensino Superior Incompleto</option>
                            <option value="s_c" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 's_c') @endif>Ensino Superior Completo</option>
                            <option value="pos" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'pos') @endif>Pós Graduação</option>
                            <option value="mest" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'mest') @endif>Mestrado</option>
                            <option value="dout" @if(isset($user->escolaridade->grau_instrucao)) @selected($user->escolaridade->grau_instrucao == 'dout') @endif>Doutorado</option>
                        </select>
                    </div>

                    <div class="col-sm">
                        <label for="formacao" class="form-label">Formação</label>
                        <input type="text" @if(isset($user->escolaridade->formacao))
                        value="{{ $user->escolaridade->formacao }}"
                        @endif name="formacao" class="form-control border-primary" maxlength="50">
                    </div>

                    <div class="col-sm">
                        <label for="proficao" class="form-control">Profição</label>
                        <input type="text" @if(isset($user->escolaridade->proficao))
                        value="{{ $user->escolaridade->proficao }}"
                        @endif name="proficao" class="form-control border-primary" maxlength="50">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
