@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <h1>Editar Empresa {{$tenant->tenant_name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update',$tenant->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('Integrador.Tenant._partials.__form')
            </form>

        </div>
    </div>
@stop
