@extends('adminlte::page')

@section('title_postfix', '| Campanhas')

@section('content_header')
    <h1>Cadastrar Nova Campanha</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('campanhas.store') }}" method="post">
                @csrf
                @include('Integrador.Campaigns._partials.__form')
            </form>

        </div>
    </div>
@stop
