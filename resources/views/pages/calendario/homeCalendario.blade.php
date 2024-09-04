@extends('layouts.default')

@section('title', 'VerboWeb - Calendario')

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

<div class="border container p-3 shadow mt-3">
    <livewire:calendario/>
</div>

@endsection
