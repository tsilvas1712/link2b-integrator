@extends('adminlte::page')

@section('title_postfix', '| Perfis disponíveis para a Empresa {$tenant->tenant_name}')

@section('content_header')
    <h1>Perfil da Empresa <strong>{{$tenant->tenant_name}}</strong></h1>
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
                    <form method="POST" action="{{route('tenants.profiles.attach',$tenant->id)}}">
                        @csrf
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    <input type="checkbox" name="profiles[]" value="{{$profile->id}}"/>
                                </td>
                                <td>{{ $profile->name }}</td>
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
