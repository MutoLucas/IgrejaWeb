# IgrejaWeb

Sistema completo para gestão de igrejas, desenvolvido com Laravel.

## 📌 Descrição

O **IgrejaWeb** é uma aplicação web feita para facilitar o gerenciamento de igrejas evangélicas. Com ele, é possível controlar membros, cultos, departamentos e outras atividades da rotina da igreja de forma centralizada e eficiente.

## 🚀 Funcionalidades

- Cadastro e gerenciamento de membros
- Registro de cultos e programações
- Gerenciamento de departamentos e ministérios
- Sistema de permissões por usuário
- Responsivo e de fácil navegação

## 🛠️ Tecnologias utilizadas

- PHP 8.x
- [Laravel](https://laravel.com/) 10
- MySQL
- Blade (engine de templates)
- Bootstrap
- jQuery
- Livewire

## ⚙️ Requisitos

- PHP >= 8.1
- Composer
- MySQL ou MariaDB
- Node.js e NPM (para compilação de assets)

## 📦 Instalação

Clone o repositório:

```bash
git clone https://github.com/MutoLucas/IgrejaWeb.git
cd IgrejaWeb
```

Instale as dependências PHP:

```bash
composer install
```

Instale as dependências front-end:

```bash
npm install
npm run build
```

Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Configure o banco de dados no `.env` e depois execute as migrations:

```bash
php artisan migrate --seed
```

Execute o servidor local:

```bash
php artisan serve
```

Acesse no navegador: `http://localhost:8000`


## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se livre para abrir uma _issue_ ou enviar um _pull request_ com melhorias ou correções.


Desenvolvido por [@MutoLucas](https://github.com/MutoLucas) 🙌

