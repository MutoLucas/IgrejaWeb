<nav class="navbar bg-dark navbar-expand-sm">
    <div class="container">
        <a href="{{ route('home.index') }}" class="navbar-brand col"><img src="{{ asset('imagens/logo_verbo.png') }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar"><i class="bi bi-list text-white"></i></button>
        <div class="collapse navbar-collapse col" id="menuNavbar">
            <div class="navbar-nav">
                <a href="{{ route('home.index') }}" class="nav-link link-light"><i class="bi bi-house-fill"></i> Home</a>
                <a href="" class="nav-link link-light">menu 2</a>
                <a href="" class="nav-link link-light">menu 3</a>
                <a href="" class="nav-link link-light">menu 4</a>
                @if(auth()->check())
                    @if(auth()->user()->tipo === 'pastor')
                    <a href="{{ route('dpt.index') }}" class="nav-link link-light"><i class="bi bi-building-fill"></i> Departamentos</a>
                    <a href="" class="nav-link link-light">DashBoard</a>
                    @endif
                @endif
            </div>

            @if(!auth()->check())
            <div class="dropdown ms-auto">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-list text-white"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login</button></li>
                    <li><a class="dropdown-item" href="{{ route('cadastro.index') }}">Cadastrar-se</a></li>
                </ul>
            </div>
            @else
            <div class="dropdown ms-auto">
                <a href="#" class="d-block link-body-emphasis text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(auth()->user()->tipo === 'pastor')
                    <strong class="text-light dropdown-toggle">Pastor </strong>
                    @endif

                    @if(auth()->user()->tipo === 'admin')
                    <strong class="text-light dropdown-toggle">Admin </strong>
                    @endif

                    @if(auth()->user()->tipo === 'usuario' || auth()->user()->tipo === 'lider')
                    <strong class="text-light">{{ auth()->user()->apelido }}</strong>
                    <img src="{{ asset('storage/' . auth()->user()->dado->foto) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small">
                    <li><a class="dropdown-item" href="#">opção</a></li>
                    <li><a class="dropdown-item" href="{{ route('edit.index', auth()->user()->id) }}"><i class="bi bi-person-fill-gear"></i> Editar Perfil</a></li>
                    <li><a class="dropdown-item" href="#">opção</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
                </ul>
            </div>
            @endif

        </div>
    </div>
</nav>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" class="container-fluid" action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="col-sm">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control border-primary" name="email" required>
                    </div>

                    <div class="col-sm">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control border-primary" name="password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="document.getElementById('loginForm').submit();">Entrar</button>
            </div>
        </div>
    </div>
</div>
