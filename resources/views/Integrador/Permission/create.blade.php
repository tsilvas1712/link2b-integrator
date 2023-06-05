@extends('adminlte::page')

@section('title_postfix', '| Perfil')

@section('content_header')
    <h1>Cadastrar Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                @include('Integrador.Permission._partials.__form')
            </form>

        </div>
    </div>
@stop
