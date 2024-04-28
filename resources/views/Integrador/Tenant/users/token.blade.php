@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <div class="row justify-content-between m-2">
        <h1>{{ $user->name }} </h1>
        @if ($user->is_active)
            <span class="bg-gradient-green p-2 rounded-lg text-md font-weight-bold">Ativo</span>
        @else
            <span class="bg-gradient-red p-2 rounded-lg text-md font-weight-bold">Parado</span>
        @endif
    @stop
</div>

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Gerar Token do Usuário <span class="text-info">{{ $user->name }}</span></h1>
        </div>
        <div class="card-body">
            <h1 class="fs-2">{{ $token }}</h1>
        </div>
    </div>
@stop
