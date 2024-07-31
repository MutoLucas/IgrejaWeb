@extends('layouts.default')

@section('title', 'home - VerboWeb')

@section('page_title', 'Home VerboWeb')

@section('content')
@if(Session::get('success'))
<div id="menssage" class="alert alert-success text-center p-2">
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

@if(Session::get('error'))
<div id="menssage" class="alert alert-danger text-center p-2">
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

@endsection
