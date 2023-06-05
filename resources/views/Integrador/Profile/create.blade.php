@extends('adminlte::page')

@section('title_postfix', '| Perfil')

@section('content_header')
    <h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" method="post">
                @csrf
                @include('Integrador.Profile._partials.__form')
            </form>

        </div>
    </div>
@stop
