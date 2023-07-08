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
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome do Usuario:</strong> {{ $user->name }}
                </li>
                <li>
                    <strong>CNPJ | CPF:</strong> {{ $user->email }}
                </li>

            </ul>
            <form action="{{ route('tenants.destroy', $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"> </i> Deletar {{ $user->name }}
                </button>

            </form>
        </div>
    </div>
@stop
