@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach

    </div>
@endif
<div class="form-group">
    <label>Nome do Perfil:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome do Perfil:" value="{{$profile->name ?? ''}}">
</div>
<div class="form-group">
    <label>Descrição do Perfil:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição do Perfil" value="{{$profile->description ?? ''}}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-save"> </i> Enviar</button>
</div>