@extends('adminlte::page')

@section('title_postfix', '| Perfil')

@section('content_header')
    <h1>Perfil {{$permission->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update',$permission->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('Integrador.Permission._partials.__form')
            </form>

        </div>
    </div>
@stop
