@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach

    </div>
@endif
<div class="form-group" hidden="true">
    <label>Tenant:</label>
    <input type="text" name="tenant_id" class="form-control" placeholder="Somente Números" value="{{$tenant ?? ''}}">
</div>
<div class="form-group">
    <label>Nome Completo:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome do Usuário:" value="{{$user->name ?? ''}}">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input type="text" name="email" class="form-control" placeholder="Somente Email" value="{{$user->email ?? ''}}">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Somente Números" value="{{$user->password ?? ''}}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-save"> </i> Enviar</button>
</div>