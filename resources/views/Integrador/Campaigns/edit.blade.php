@extends('adminlte::page')

@section('title_postfix', '| Campanha')

@section('content_header')
    <h1>Campanha {{$campaign->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('campanhas.update',$campaign->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('Integrador.Campaigns._partials.__form')
            </form>

        </div>
    </div>
@stop
