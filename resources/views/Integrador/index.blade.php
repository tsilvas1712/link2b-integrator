@extends('adminlte::page')

@section('title_postfix', '| Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box">
				<span class="info-box-icon bg-primary elevation-1"><i class="fas fa-people-arrows"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Clientes</span>
					<span class="info-box-number">10</span>
				</div>

			</div>

		</div>

		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
				<span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Mensagens</span>
					<span class="info-box-number">41,410</span>
				</div>

			</div>

		</div>


		<div class="clearfix hidden-md-up"></div>
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
				<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cogs"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Erros</span>
					<span class="info-box-number">760</span>
				</div>

			</div>

		</div>

		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
				<span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Usuários</span>
					<span class="info-box-number">2,000</span>
				</div>

			</div>

		</div>

	</div>
@stop

@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
@stop

