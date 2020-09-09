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
    <input class="form-control" id="price" name="price" type="text" min="100.00" max="100000.00" step="0.01" value="{{old('price',$product->price)}}" placeholder="100,00 ou maior" style="text-align:right" required />
</div>

<div class="form-group">
    <label for="img_src">Imagem</label>
    <div class="row">
        <div class="col-md-3">
            @if(!empty($product->img_src))
                <img src="{{ filter_var($product->img_src, FILTER_VALIDATE_URL)? $product->img_src : asset('img/products/'.$product->img_src) }}"
                     width="200">
            @endif
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5"><label for="img_src_file">File</label>
                    <input class="form-control" id="img_src_file" name="img_src_file" type="file" accept="image/*" /></div>
                <div class="col-md-2">OU</div>
                <div class="col-md-5">
                    <label for="img_src_url">URL</label>
                    <input class="form-control" id="img_src_url" name="img_src_url" type="text" value="{{old('img_src_url',filter_var($product->img_src, FILTER_VALIDATE_URL)? $product->img_src : '')}}" />
                </div>
            </div>
        </div>
    </div>
</div>
