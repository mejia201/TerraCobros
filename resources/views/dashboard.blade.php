@extends('layouts/dashboard')
@section('title', 'Dashboard')
@section('contenido')
<div class="fs-6">

    <h4 class="mt-4">Bienvenido, {{ Auth::user()->name }}</h4>

    
</div>
@endsection