@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <div class="row justify-content-between m-2">
        <h1>Empresa {{ $tenant->tenant_name }} </h1>
        @if ($tenant->active)
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
                    <strong>Nome da Empresa:</strong> {{ $tenant->tenant_name }}
                </li>
                <li>
                    <strong>CNPJ | CPF:</strong> {{ $tenant->cpf_cnpj }}
                </li>
                <li>
                    <strong>Telefone:</strong> {{ $tenant->phone }}
                </li>
                <li>
                    <strong>Contato:</strong> {{ $tenant->contact }}
                </li>
            </ul>
            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"> </i> Deletar {{ $tenant->tenant_name }}
                </button>

            </form>
        </div>
    </div>
@stop
