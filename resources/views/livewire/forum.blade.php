<div class="container mt-5">
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <h1 class="mb-4 text-center">Fórum de Perguntas e Respostas</h1>
    <div class="container my-4">
        <div class="card  border border-dark shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-5">
                        <input type="text" wire:model="assuntoBusca" class="form-control" id="assunto" placeholder="Digite o assunto">
                    </div>
                    <div class="col-md-5">
                        <input type="text" wire:model="nomeBusca" class="form-control" id="nomePessoa" placeholder="Digite o nome da pessoa">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button wire:click="busca" class="btn btn-primary me-2"><i class="bi bi-search"></i></button>
                        <button wire:click="resetBusca" class="btn btn-secondary"><i class="bi bi-x-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!auth()->check())
    <div class="accordion mb-3" id="accordionPergunta">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingPergunta">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePergunta" aria-controls="collapsePergunta">
                    Faça uma nova pergunta
                </button>
            </h2>
            <div id="collapsePergunta" class="accordion-collapse collapse" aria-labelledby="headingPergunta" data-bs-parent="#accordionPergunta">
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="pergunta" class="form-label">Seu Nome</label>
                        <input wire:model="nomePessoa" type="text" class="form-control" id="pergunta" placeholder="Digite sua pergunta" required>
                    </div>
                    <div class="mb-3">
                        <label for="pergunta" class="form-label">Sua Pergunta</label>
                        <input wire:model="pergunta" type="text" class="form-control" id="pergunta" placeholder="Digite sua pergunta" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Texto da pergunta</label>
                        <textarea wire:model="textoPergunta" class="form-control" id="descricao" rows="3" placeholder="Descreva sua pergunta..." required></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lcev34qAAAAAJ8CW3ChbIURfH02Ucj3D2phRxx1" data-callback="recaptchaCallback"></div>
                    <input type="hidden" wire:model="recaptchaToken" id="recaptcha-token">
                    <button type="submit" class="btn btn-primary mt-2" onclick="valida()" wire:click="criarPergunta">Enviar Pergunta</button>
                </div>
            </div>
        </div>
    </div>
    @elseif(auth()->check() && auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'lider')
    <div class="accordion mb-3" id="accordionPergunta">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingPergunta">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePergunta" aria-controls="collapsePergunta">
                    Faça uma nova pergunta
                </button>
            </h2>
            <div id="collapsePergunta" class="accordion-collapse collapse" aria-labelledby="headingPergunta" data-bs-parent="#accordionPergunta">
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="pergunta" class="form-label">Sua Pergunta</label>
                        <input wire:model="pergunta" type="text" class="form-control" id="pergunta" placeholder="Digite sua pergunta">
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea wire:model="textoPergunta" class="form-control" id="descricao" rows="3" placeholder="Descreva sua pergunta..."></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lcev34qAAAAAJ8CW3ChbIURfH02Ucj3D2phRxx1" data-callback="recaptchaCallback"></div>
                    <input type="hidden" wire:model="recaptchaToken" id="recaptcha-token">
                    <button type="submit" class="btn btn-primary mt-2" onclick="valida()" wire:click="criarPergunta">Enviar Pergunta</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        function recaptchaCallback(token) {
            document.getElementById('recaptcha-token').value = token;
            @this.set('recaptchaToken', token); // Atualiza o token no Livewire
        }

        function valida() {
            // Verifica se o reCAPTCHA foi marcado
            if (grecaptcha.getResponse() == "") {
                alert("Você precisa marcar o reCaptcha");
                return false;
            }
        }

    </script>

    @foreach ($perguntas as $pergunta)
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pergunta</h5>
            <small id="info1" class="d-none d-md-inline">Postado por {{ $pergunta->pessoa }} em {{ $pergunta->created_at->format('d/m/Y') }}</small>
            <small id="info2" class="d-md-none">Postado em {{ $pergunta->created_at->format('d/m/Y') }}</small>

        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $pergunta->pergunta }}</h5>
            <p class="card-text">{{ $pergunta->texto }}</p>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#respostas{{ $pergunta->id }}" aria-expanded="false" aria-controls="respostas{{ $pergunta->id }}">
                    <i class="bi bi-chat-dots"></i> Ver Respostas
                </button>

                @if(auth()->check() && auth()->user()->tipo == 'pastor')
                <button wire:click="excluirPergunta({{ $pergunta->id }})" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash"></i> Excluir Pergunta
                </button>
                @endif
            </div>

            <div class="collapse mt-3" id="respostas{{ $pergunta->id }}">
                <div class="card card-body border-0">
                    @forelse ($respostas->where('pergunta_id', $pergunta->id) as $resposta)
                    <div class="border-bottom mb-2 p-2 rounded-3 bg-light">
                        <p><strong class="fs-5">Resposta de {{ $resposta->nome }}:</strong> {{ $resposta->resposta }}</p>
                        <small class="text-muted">Respondido em {{ $resposta->created_at->format('d/m/Y H:i') }} <button class="btn btn-sm btn-outline-danger" wire:click="excluirResposta({{ $resposta->id }})">Excluir Resposta</button></small>
                    </div>
                    @empty
                    <div class="border-bottom mb-2 p-2 rounded-3 bg-light text-muted">
                        <p><strong>Sem respostas ainda</strong></p>
                    </div>
                    @endforelse

                    @if(auth()->check() && (auth()->user()->tipo == 'pastor' || auth()->user()->tipo == 'lider'))
                    <div class="mt-3">
                        <label for="resposta{{ $pergunta->id }}" class="form-label">Sua Resposta</label>
                        <textarea wire:model="resposta" class="form-control" id="resposta{{ $pergunta->id }}" rows="2" placeholder="Escreva sua resposta..." required></textarea>
                        <button wire:click="criarResposta({{ $pergunta->id }})" type="submit" class="btn btn-success mt-2"><i class="bi bi-send"></i> Enviar Resposta</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
