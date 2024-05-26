@extends('adminlte::page')

@section('title_postfix', '| Datasys - Integração')

@section('content_header')
    <h1>Datasys - Integração</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Inportar Dados Datasys</h3><br>
            <div class="card-body">
                <form class="d-flex flex-column p-2 d-grid gap-3" action="{{ route('datasys.upload') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
            </div>
            <div class="fields">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                    <label class="input-group-text" for="import_csv">Upload</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Import CSV</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Filial</th>
                    <th>Data Pedido</th>
                    <th>Tipo Pedido</th>
                    <th>Modalidade</th>
                    <th>Qtde</th>
                    <th>Valor</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($datasys as $row)
                    <tr>
                        <td>{{ $row['id_venda'] }}</td>
                        <td>{{ $row['filial'] }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($row['data_pedido'])) }}</td>
                        <td>{{ $row['tipo_pedido'] }}</td>
                        <td>{{ $row['modalidade'] }}</td>
                        <td>{{ $row['qantidade'] }}</td>
                        <td>R$ {{ number_format($row['valor_tabela'], 2, ',', '.') }}</td>
                        <td>{{ $row['nome_vendedor'] }}</td>
                        <td>{{ $row['nome_vendedor'] }}</td>
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
