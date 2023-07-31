@extends('adminlte::page')

@section('title_postfix', '| Datasys - Integração')

@section('content_header')
    <h1>Datasys - Integração</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Campanha</th>
                        <th>Telefone</th>
                        <th>Filial</th>
                        <th>Data Pedido</th>
                        <th>Tipo Pedido</th>
                        <th>Valor</th>
                        <th>Cliente</th>
                        <th hidden>Vendedor</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr class="text-xs">
                            <td>{{ $sale->id_venda }}</td>
                            <td class="bg-gradient-gray">{{ $sale->gsm }}</td>
                            <td>{{ $sale->name }}</td>
                            <td >{{ $sale->filial }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($sale->data_pedido)) }}</td>
                            <td>{{ $sale->modalidade }}</td>
                            <td>R$ {{ number_format($sale->valor_caixa, 2, ',', '.') }}</td>
                            <td>{{ Str::upper($sale->nome_cliente) }}</td>
                            <td hidden>{{ Str::upper($sale->nome_vendedor) }}</td>
                            @switch($sale->status)
                                @case('PENDENTE')
                                    <td>
                                        <span class="badge badge-primary">
                                            Pendente
                                        </span>
                                    </td>
                                @break

                                @case('PORTABILIDADE')
                                    <td>
                                        <span class="badge badge-warning">
                                            Portabilidade
                                        </span>
                                    </td>
                                @break

                                @case('ENVIADO')
                                    <td>
                                        <span class="badge badge-success">
                                            Enviado
                                        </span>
                                    </td>
                                @break

                                @case('AGENDADO')
                                    <td>
                                        <span class="badge badge-info">
                                            Agendado
                                        </span>
                                    </td>
                                @break

                                @case('ERROR')
                                    <td>
                                        <span class="badge badge-danger">
                                            Error
                                        </span>
                                    </td>
                                @break

                                @default
                            @endswitch





                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $sales->links() }}

        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
