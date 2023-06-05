@extends('adminlte::page')

@section('title_postfix', '| Permissões disponíveis para o perfil {$profile->name}')

@section('content_header')
    <h1>Permissões do Perfil <strong>{{$profile->name}}</strong></h1>
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
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="POST" action="{{route('profiles.permissions.attach',$profile->id)}}">
                        @csrf
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}"/>
                                </td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @include('Integrador._includes.alerts')
                                <button type="submit" class="btn btn-success" >Vincular</button>

                            </td>
                        </tr>

                    </form>
                </tbody>
            </table>
        </div>

    </div>
@stop
