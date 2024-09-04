@extends('layouts.default')

@section('title', 'VerboWeb - Departamentos')

@section('content')

@if(Session::get('error'))
<div id="menssage" class="alert alert-danger p-3 text-center">
    {{ Session::get('error') }}
</div>
<script>
    setTimeout(function() {
        var menssage = document.getElementById('menssage');
        if (menssage) {
            menssage.style.display = 'none';
        }
    }, 4000);
</script>
@endif

@if(Session::Get('success'))
<div id="menssage" class="alert alert-success p-3 text-center">
    {{ Session::get('success') }}
</div>
<script>
    setTimeout(function() {
        var menssage = document.getElementById('menssage');
        if (menssage) {
            menssage.style.display = 'none';
        }
    }, 4000);
</script>
@endif

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
