@extends('adminlte::page')

@section('title_postfix', '| Clientes')

@section('content_header')
	<h1>Clientes <a href="{{ route('clientes.create')}}" class="btn btn-success"> <i class="fa fa-plus"></i> Cliente</a>
	</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-header">
			#filtros
		</div>
		<div class="card-body">
			<table class="table table-condensed">
				<thead>
				<tr>
					<th>Nome</th>
					<th>email</th>
					<th>Status</th>
					<th>ações</th>
				</tr>
				</thead>
				<tbody>
				@foreach($customers as $customer)
					<tr>
						<td>{{$customer->name}}</td>
						<td>{{$customer->email}}</td>
						@if($customer->active)
							<td class="bg-success text-white text-center">
								<b>Ativo</b>
							</td>
						@else
							<td class="bg-danger text-white text-center">
								<b>Parado</b>
							</td>
						@endif

						<td>
							<a class="btn btn-warning" href="{{route('clientes.show',$customer->id)}}" title="Ver Registro"><i
										class="fa fa-eye"></i></a>
							<a class="btn btn-primary" title="Editar Registro"><i class="fa fa-cogs"></i></a>
							<a class="btn btn-danger" title="Deletar Registro"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="card-footer">
			{!! $customers->links() !!}

		</div>
	</div>
@stop


