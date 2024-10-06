@extends('layouts.default')

@section('title', 'VerboWeb - Departamentos')

@section('content')

<div class="container p-3">
    <div class="row">
        <div class="col-sm shadow m-2 p-3">
            <livewire:table-dpt/>
        </div>

        <div class="col-sm shadow m-2 p-3">
            <livewire:table-pessoa-dpt/>
        </div>
    </div>
</div>


@endsection
