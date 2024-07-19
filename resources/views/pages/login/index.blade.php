@extends('layouts.default')

@section('title', 'VerboWeb - Login')

@section('content')

@if(Session::get('error'))
<div class="alert alert-danger text-center p-2">
    {{ Session::get('error') }}
</div>
@endif


<div class="container mt-5 shadow text-center" style="max-width: 50%">
    <h1 >LOGIN</h1>
    <div class="container rounded p-3">
        <form action="" method="POST">
            @csrf
            
        </form>
    </div>
</div>

@endsection
