{{csrf_field()}}
<div class="form-group">
    <label for="name">Nome</label>
    <input class="form-control" id="name" name="name" value="{{old('name',$product->name)}}" required>
</div>

<div class="form-group">
    <label for="descricao">Descrição</label>
    <input class="form-control" id="descricao" name="descricao" type="text" maxlength="191" value="{{old('descricao',$product->descricao)}}" required>
</div>

<div class="form-group">
    <label for="preco">Preço</label>
    <input class="form-control" id="preco" name="preco" type="number" min="0.00" max="100000.00" step="0.01"value="{{old('preco',$product->preco)}}" required />
</div>
