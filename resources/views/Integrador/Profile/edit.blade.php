@extends('adminlte::page')

@section('title_postfix', '| Perfil')

@section('content_header')
    <h1>Perfil {{$profile->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update',$profile->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('Integrador.Profile._partials.__form')
            </form>

        </div>
    </div>
@stop
