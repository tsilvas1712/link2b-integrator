@extends('adminlte::page')

@section('title_postfix', '| Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{ $panels['campaigns'] }}</h3>
                    <p>Campanhas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
                <a href="{{ route('campanhas.index') }}" class="small-box-footer">Mais Informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $panels['sales'] }}</h3>
                    <p>Total de Mensagens</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-email"></i>
                </div>
                <a href="{{ route('mensagens.index') }}" class="small-box-footer">Mais Informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $panels['agendadas'] }}</h3>
                    <p>Mensagens Agendadas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email-unread"></i>
                </div>
                <a href="{{route('mensagens.status', 'AGENDADO')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $panels['enviadas'] }}</h3>
                    <p>Mensagens Enviadas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-email-outline"></i>
                </div>
                <a href="{{route('mensagens.status', 'ENVIADO')}}" class="small-box-footer">Mais Informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <h1>Campanhas</h1>
    <div class="row">
        @foreach ($campaigns as $campaign)
            <div class="col-lg-4 col-6 ">
                <a href="{{ route('mensagens.campaing', $campaign->id) }}">
                    <div class="small-box bg-lightblue p-4">
                        {{ $campaign->name }}
                    </div>
                </a>
            </div>
        @endforeach

    </div>

    <h1>Mensagens</h1>
    <div class="row">
        <div class="col-lg-2 col-6 ">
            <a href="{{ route('mensagens.status', 'ENVIADO') }}">
                <div class="d-flex justify-content-center small-box wid bg-success p-4">
                    <h2>Enviadas</h2>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-6 ">
            <a href="{{ route('mensagens.status', 'PENDENTE') }}">
                <div class="d-flex justify-content-center small-box bg-primary p-4">
                    <h2>Pendentes</h2>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-6 ">
            <a href="{{ route('mensagens.status', 'AGENDADO') }}">
                <div class="d-flex justify-content-center small-box bg-info p-4">
                    <h2>Agendadas</h2>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-6 ">
            <a href="{{ route('mensagens.status', 'ERROR') }}">
                <div class="d-flex justify-content-center small-box bg-danger p-4">
                    <h2>Erros</h2>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-6 ">
            <a href="{{ route('mensagens.status', 'REPETIDO') }}">
                <div class="d-flex justify-content-center small-box bg-purple p-4">
                    <h2>Repetidos</h2>
                </div>
            </a>
        </div>


    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
