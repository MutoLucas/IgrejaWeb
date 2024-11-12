@extends('layouts.default')

@section('title','Listagem de Membros')

@section('content')

<div class="container-fluid ">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Listagem de Membros</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($membros as $membro)
                <tr>
                <td class="text-center"><img src="{{ asset('storage/'.$membro->foto) }}" alt="Foto do membro" class="rounded-circle" style="width: 50px; height: 50px"></td>
                    <td class="text-center">{{ $membro->nome }}</td>
                    <td class="text-center">{{ $membro->telefone }}</td>
                    <td class="text-center">{{ $membro->email }}</td>
                    <td class="text-center"><a href="{{ route('membro.info',['id' => $membro->id]) }}" class="btn btn btn-outline-info"><i class="bi bi-info-circle"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $membros->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection()
