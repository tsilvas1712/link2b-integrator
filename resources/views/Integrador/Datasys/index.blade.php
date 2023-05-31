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
                        <th>Area</th>
                        <th>Filial</th>
                        <th>Data Pedido</th>
                        <th>Tipo Pedido</th>
                        <th>Qtde</th>
                        <th>Valor</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datasys as $row)
                        <tr>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['Area'] }}</td>
                            <td>{{ $row['Filial'] }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($row['Data_x0020_pedido'])) }}</td>
                            <td>{{ $row['Grupo_x0020_Estoque'] }}</td>
                            <td>{{ $row['Qtde'] }}</td>
                            <td>R$ {{ number_format($row['Valor_x0020_Tabela'], 2, ',', '.') }}</td>
                            <td>{{ $row['Nome_x0020_Vendedor'] }}</td>
                            <td>{{ $row['Nome_x0020_Cliente'] }}</td>


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


        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
