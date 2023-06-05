@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
    <div class="row justify-content-between m-2">
        <h1>Perfil {{ $profile->name }} </h1>
    @stop
</div>

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome do Perfil:</strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $profile->description }}
                </li>
            </ul>
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"> </i> Deletar {{ $profile->name }}
                </button>

            </form>
        </div>
    </div>
@stop
