@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <h1>{{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('Integrador.Tenant.users._partials.__form')
            </form>

        </div>
    </div>
@stop
