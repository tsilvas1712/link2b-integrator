@extends('adminlte::page')

@section('title_postfix', '| Permissões do Perfil {$profile->name}')

@section('content_header')
    <h1>Permissões do Perfil {{$profile->name}}
        <a href="{{ route('profiles.permissions.available',$profile->id) }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Adicionar nova permissão
        </a>
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
                                <a class="btn btn-warning" href="#"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="#"
                                   title="Editar Registro"><i class="fa fa-cogs"></i></a>
                                <a class="btn btn-info" title="Permissões"><i class="fa fa-lock"></i></a>
                                <a class="btn btn-danger" title="Deletar Registro"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
