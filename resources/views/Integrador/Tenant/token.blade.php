@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <div class="row justify-content-between m-2">
        <h1>{{ $tenant->tenant_name }} </h1>
        @if ($tenant->active)
            <span class="bg-gradient-green p-2 rounded-lg text-md font-weight-bold">Ativo</span>
        @else
            <span class="bg-gradient-red p-2 rounded-lg text-md font-weight-bold">Parado</span>
        @endif
    @stop
</div>

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Token</h1>
        </div>
        <div class="card-body">
            <h1 class="fs-2 text-primary">{{ $tenant->token }}</h1>
        </div>
        <div class="card-footer">
            <a href="{{ route('tenant.create.token', $tenant->id) }}" class="btn btn-primary">Gerar Novo Token</a>
        </div>
    </div>
@stop
