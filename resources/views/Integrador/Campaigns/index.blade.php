@extends('adminlte::page')

@section('title_postfix', '| Campanhas')

@section('content_header')
    <h1>Campanhas <a href="{{ route('campanhas.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Adicionar</a>
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
                            <td></td>
                            @if ($campaign->active)
                                <td>
                                    <span class="badge badge-success">
                                        Ativo
                                    </span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-danger">
                                        Bloquedo
                                    </span>
                                </td>
                            @endif

                            <td>
                                <a class="btn btn-warning" href="{{ route('campanhas.show', $campaign->id) }}"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('campanhas.edit', $campaign->id) }}"
                                    title="Editar Registro"><i class="fa fa-pen"></i></a>
                                <a class="btn btn-secondary" href="{{ route('campanhas.matience', $campaign->id) }}"
                                   title="Manutenção"><i class="fa fa-cogs"></i></a>

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
