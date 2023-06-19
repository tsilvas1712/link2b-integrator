@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <div class="row justify-content-between m-2">
        <h1>Cliente {{ $campaign->name }} </h1>
        @if ($campaign->active)
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
                    <strong>Nome da Campanha:</strong> {{ $campaign->name }}
                </li>
                <li>
                    <strong>Modalidades de vendas:</strong> {{ $campaign->sales_modalities }}
                </li>
                <li>
                    <strong>Endpoint Link2B:</strong> {{ $campaign->endpoint_link2b }}
                </li>
                <li>
                    <strong>Token Link2B:</strong> {{ $campaign->token_link2b }}
                </li>
                <li>
                    <strong>Endpoint Integração:</strong> {{ $campaign->endpoint_customer }}
                </li>
                <li>
                    <strong>Token Integração:</strong> {{ $campaign->token_customer }}
                </li>
            </ul>
            <form action="{{ route('campanhas.destroy', $campaign->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"> </i> Deletar {{ $campaign->name }}
                </button>

            </form>
        </div>
    </div>
@stop
