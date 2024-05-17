@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <h1>{{ $tenant->tenant_name }} <a href="{{ route('tenant.users.create', $tenant->id) }}" class="btn btn-success"> <i
                class="fa fa-plus"></i> Usuário</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->is_active)
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
                                <a class="btn btn-warning" href="{{ route('tenant.users.show', $user->id) }}"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('tenant.users.edit', $user->id) }}"
                                    title="Editar Registro"><i class="fa fa-cogs"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">


        </div>
    </div>
@stop
