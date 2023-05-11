@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
	<h1>Cadastrar Novo Cliente</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			<form action="{{route('clientes.store')}}" method="post">
				@csrf
				<div class="form-group">
					<label>Nome da Empresa:</label>
					<input type="text" name="name" class="form-control" placeholder="Nome da Empresa:">
				</div>
				<div class="form-group">
					<label>E-mail:</label>
					<input type="text" name="email" class="form-control" placeholder="E-mail:">
				</div>
				<div class="form-group">
					<label>Endpoint Link2B:</label>
					<input type="text" name="endpoint_link2b" class="form-control" placeholder="Endpoint Link2B:">
				</div>
				<div class="form-group">
					<label>Token Link2B:</label>
					<textarea type="text" name="token_link2b" class="form-control" placeholder="Token Link2B:"></textarea>
				</div>
				<div class="form-group">
					<label>Endpoint Integração:</label>
					<input type="text" name="endpoint_customer" class="form-control" placeholder="Endpoint Integração:">
				</div>
				<div class="form-group">
					<label>Token Integração:</label>
					<textarea type="text" name="token_customer" class="form-control" placeholder="Token Integração:"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-save"> </i> Enviar</button>
				</div>
			</form>

		</div>
	</div>
@stop


