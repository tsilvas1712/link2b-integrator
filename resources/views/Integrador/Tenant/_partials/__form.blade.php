@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach

    </div>
@endif
<div class="form-group">
    <label>Nome da Empresa:</label>
    <input type="text" name="tenant_name" class="form-control" placeholder="Nome da Empresa:" value="{{$tenant->tenant_name ?? ''}}">
</div>
<div class="form-group">
    <label>CNPJ | CPF:</label>
    <input type="text" name="cpf_cnpj" class="form-control" placeholder="Somente Números" value="{{$tenant->cpf_cnpj ?? ''}}">
</div>
<div class="form-group">
    <label>Telefone:</label>
    <input type="text" name="phone" class="form-control" placeholder="Somente Números" value="{{$tenant->phone ?? ''}}">
</div>
<div class="form-group">
    <label>Nome de Contato:</label>
    <input type="text" name="contact" class="form-control" placeholder="Nome do Contato" value="{{$tenant->contact ?? ''}}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-save"> </i> Enviar</button>
</div>