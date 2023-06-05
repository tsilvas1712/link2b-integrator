@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach

    </div>
@endif
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{$permission->name ?? ''}}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{$permission->description ?? ''}}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-save"> </i> Enviar</button>
</div>