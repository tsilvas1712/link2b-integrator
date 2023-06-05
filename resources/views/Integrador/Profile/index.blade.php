@extends('adminlte::page')

@section('title_postfix', '| Perfis')

@section('content_header')
    <h1>Perfis <a href="{{ route('profiles.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Adicionar</a>
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
                                <a class="btn btn-warning" href="{{ route('profiles.show', $profile->id) }}"
                                    title="Ver Registro"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{route('profiles.edit',$profile->id)}}"
                                   title="Editar Registro"><i class="fa fa-cogs"></i></a>
                                <a class="btn btn-info"  href="{{route('profiles.permissions',$profile->id)}}" title="Permissões"><i class="fa fa-lock"></i></a>
                                <a class="btn btn-danger" title="Deletar Registro"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $profiles->links() !!}

        </div>
    </div>
@stop
