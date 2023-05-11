@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
	<div class="row justify-content-between m-2">
		<h1>Cliente {{$customer->name}} </h1>
		@if($customer->active)
			<span class="bg-gradient-green p-2 rounded-lg text-md font-weight-bold">Ativo</span>
		@else
			<span class="bg-gradient-red p-2 rounded-lg text-md font-weight-bold">Parado</span>
		@endif
		@stop
	</div>

	@section('content')
		<div class="card">
			<div class="card-body">
				<ul>
					<li>
						<strong>Nome da Empresa:</strong> {{$customer->name}}
					</li>
					<li>
						<strong>E-mail:</strong> {{$customer->email}}
					</li>
					<li>
						<strong>Endpoint Link2B:</strong> {{ $customer->endpoint_link2b }}
					</li>
					<li>
						<strong>Token Link2B:</strong> {{$customer->token_link2b}}
					</li>
					<li>
						<strong>Endpoint Integração:</strong> {{$customer->endpoint_customer}}
					</li>
					<li>
						<strong>Token Integração:</strong> {{$customer->endpoint_customer}}
					</li>
				</ul>
				<form action="{{route('clientes.destroy',$customer->id)}}" method="post">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"> </i> Deletar {{$customer->name}}
					</button>

				</form>
			</div>
		</div>
	@stop


