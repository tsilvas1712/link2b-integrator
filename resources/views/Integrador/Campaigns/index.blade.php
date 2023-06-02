@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <h1>Clientes <a href="{{ route('clientes.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Cliente</a>
    </h1>
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
                        <th>Campanha</th>
                        <th>Total de Mensagens</th>
                        <th>Status</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->name }}</td>
                            <td>{{ $campaign->email }}</td>
                            @if ($campaign->active)
                                <td class="bg-success text-white text-center">
                                    <b>Ativo</b>
                                </td>
                            @else
                                <td class="bg-danger text-white text-center">
                                    <b>Parado</b>
                                </td>
                            @endif

                            <td>
                                <a class="btn btn-warning" href="{{ route('clientes.show', $campaign->id) }}"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" title="Editar Registro"><i class="fa fa-cogs"></i></a>
                                <a class="btn btn-danger" title="Deletar Registro"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $campaigns->links() !!}

        </div>
    </div>
@stop
