@extends('adminlte::page')

@section('title_postfix', '| Perfis da Empresa {$tenant->tenant_name}')

@section('content_header')
    <h1>Perfis da Empresa {{$tenant->tenant_name}}
        <a href="{{ route('tenants.profiles.available',$tenant->id) }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Adicionar novo Perfil
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
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                            <td>{{ $profile->description }}</td>
                            <td>
                                <a class="btn btn-danger" title="Deletar Registro"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
