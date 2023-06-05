@extends('adminlte::page')

@section('title_postfix', '| Permissão')

@section('content_header')
    <div class="row justify-content-between m-2">
        <h1>Permissão {{ $permission->name }} </h1>
    @stop
</div>

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome do Perfil:</strong> {{ $permission->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $permission->description }}
                </li>
            </ul>
            <form action="{{ route('profiles.destroy', $permission->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"> </i> Deletar {{ $permission->name }}
                </button>

            </form>
        </div>
    </div>
@stop
