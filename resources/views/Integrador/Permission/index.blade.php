@extends('adminlte::page')

@section('title_postfix', '| Permissões')

@section('content_header')
    <h1>Permissões <a href="{{ route('permissions.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i>
            Adicionar</a>
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
                        <th>Descrição</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('permissions.show', $permission->id) }}"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}"
                                    title="Editar Registro"><i class="fa fa-cogs"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $permissions->links() !!}

        </div>
    </div>
@stop
