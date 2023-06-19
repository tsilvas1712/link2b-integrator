<div class="form-group">
    <label>Nome da Campanha:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome da Campanha:" value="{{$campaign->name ?? ''}}">
</div>
<div class="form-group">
    <label>Modalidades de Vendas:</label>
    <textarea type="text" name="sales_modalities"  class="form-control" placeholder="Palavras divididas por ';'">{{$campaign->sales_modalities ?? ''}}</textarea>
</div>
<div class="form-group">
    <label>Endpoint Link2B:</label>
    <input type="text" name="endpoint_link2b" class="form-control" placeholder="Endpoint Link2B:" value="{{$campaign->endpoint_link2b ??''}}">
</div>
<div class="form-group">
    <label>Token Link2B:</label>
    <textarea type="text" name="token_link2b" class="form-control" placeholder="Token Link2B:" >{{$campaign->token_link2b ??''}}</textarea>
</div>
<div class="form-group">
    <label>Endpoint Integração:</label>
    <input type="text" name="endpoint_customer" class="form-control" placeholder="Endpoint Integração:" value="{{$campaign->endpoint_customer ??''}}" >
</div>
<div class="form-group">
    <label>Token Integração:</label>
    <textarea type="text" name="token_customer" class="form-control" placeholder="Token Integração:">{{$campaign->token_customer ??''}}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-save"> </i> Enviar</button>
</div>