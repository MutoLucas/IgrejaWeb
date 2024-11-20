@extends('layouts.default')

@section('title', 'IgrejaWeb - Departamentos')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm shadow m-2 p-3">
            <livewire:table-dpt/>
        </div>

        <div class="col-sm shadow m-2 p-3">
            @if(auth()->user()->tipo == 'lider')
            <livewire:table-pessoa-dpt-lider/>
            @else
            <livewire:table-pessoa-dpt/>
            @endif
        </div>
    </div>
</div>


@endsection
