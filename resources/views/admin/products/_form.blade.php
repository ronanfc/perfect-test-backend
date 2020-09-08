{{csrf_field()}}
<div class="form-group">
    <label for="name">Nome</label>
    <input class="form-control" id="name" name="name" value="{{old('name',$product->name)}}" required>
</div>

<div class="form-group">
    <label for="description">Descrição</label>
    <textarea type="text" rows='5' class="form-control" id="description" name="description" required>{{old('description',$product->description)}}</textarea>
</div>

<div class="form-group">
    <label for="price">Preço</label>
    <input class="form-control" id="price" name="price" type="number" min="100.00" max="100000.00" step="0.01" value="{{old('price',$product->price)}}" placeholder="100,00 ou maior" required />
</div>
