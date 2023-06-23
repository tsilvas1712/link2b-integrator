@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Adicionar</a>
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
                        <th>Nome</th>
                        <th>CNPJ | CPF</th>
                        <th>Status</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>{{ $tenant->tenant_name }}</td>
                            <td>{{ $tenant->cpf_cnpj }}</td>
                            @if ($tenant->active)
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
                                <a class="btn btn-warning" href="{{ route('tenants.show', $tenant->id) }}"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('tenants.edit', $tenant->id) }}"
                                    title="Editar Registro"><i class="fa fa-cogs"></i></a>
                                <a class="btn btn-info" href="{{ route('tenants.profiles', $tenant->id) }}"
                                    title="Selecionar Perfil"><i class="fa fa-address-book"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $tenants->links() !!}

        </div>
    </div>
@stop
