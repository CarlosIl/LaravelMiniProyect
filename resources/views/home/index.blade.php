@extends('layouts.master-login')

@section('content')
    <h1>Home</h1>

    @auth
        <p>Bienvenido {{ auth()->user()->name ?? auth()->user()->username }}, estás autenticado a la página</p>
        <p>
            <a href="/logout">Logout</a>
        </p>
    @endauth

    @guest
        <p>Para ver el contenido <a href="/login">inicia sesión</a></p>
    @endguest
@endsection
