@extends('adminlte::page')

@section('title_postfix', '| Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-3 col-6">

			<div class="small-box bg-info">
				<div class="inner">
					<h3>{{$panels['tenants']}}</h3>
					<p>Empresas</p>
				</div>
				<div class="icon">
					<i class="ion ion-cube"></i>
				</div>
				<a href="{{route('tenants.index')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">

			<div class="small-box bg-success">
				<div class="inner">
					<h3>{{$panels['campaigns']}}</h3>
					<p>Campanhas</p>
				</div>
				<div class="icon">
					<i class="ion ion-paper-airplane"></i>
				</div>
				<a href="{{route('campanhas.index')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">

			<div class="small-box bg-blue">
				<div class="inner">
					<h3>{{$panels['users']}}</h3>
					<p>Usuários Registrados</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">

			<div class="small-box bg-indigo">
				<div class="inner">
					<h3>{{$panels['sales']}}</h3>
					<p>Total de Mensagens</p>
				</div>
				<div class="icon">
					<i class="ion ion-email-unread"></i>
				</div>
				<a href="{{route('mensagens.index')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

	</div>
@stop

@section('css')
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="/css/admin_custom.css">
@stop

