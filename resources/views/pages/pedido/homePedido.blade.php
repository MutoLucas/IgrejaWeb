@extends('layouts.default')

@section('title','Pedidos - VerboWeb')

@section('content')

<div class="container p-3">
    <div class="shadow mb-2 p-3">
        @if(auth()->user()->tipo == "admin" || auth()->user()->tipo == "pastor")
        <livewire:tablePedidos />
        @else
        <livewire:tablePedidosUsers />
        @endif
    </div>
</div>

@endsection
