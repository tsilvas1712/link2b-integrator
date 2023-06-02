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
                        <th>Vendedor</th>
                        <th>Cliente</th>
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
                            <td>{{ $sale->nome_vendedor }}</td>
                            <td>{{ $sale->nome_cliente }}</td>


                            <td>
                                <a class="btn btn-warning" href="#" title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" title="Editar Registro"><i class="fa fa-cogs"></i></a>
                                <a class="btn btn-danger" title="Deletar Registro"><i class="fa fa-trash"></i></a>
                            </td>
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
