@extends('adminlte::page')

@section('title_postfix', '| Usuários')

@section('content_header')
    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.users.save') }}" method="post">
                @csrf
                @include('Integrador.Tenant.users._partials.__form')
            </form>

        </div>
    </div>
@stop
