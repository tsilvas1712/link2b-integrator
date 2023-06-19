@extends('adminlte::page')

@section('title_postfix', '| Datasys - Integração')

@section('content_header')
    <h1>Datasys - Integração</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            #filtros
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Filial</th>
                        <th>Data Pedido</th>
                        <th>Tipo Pedido</th>
                        <th>Valor</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id_venda }}</td>
                            <td>{{ $sale->filial }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($sale->data_pedido)) }}</td>
                            <td>{{ $sale->modalidade_venda }}</td>
                            <td>R$ {{ number_format($sale->valor_total, 2, ',', '.') }}</td>
                            <td>{{ $sale->nome_cliente }}</td>
                            <td>{{ $sale->nome_vendedor }}</td>
                            @if ($sale->status)
                                <td>
                                    <span class="badge badge-success">
                                       Enviado
                                    </span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-danger">
                                       Não enviado
                                    </span>
                                </td>
                            @endif




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
