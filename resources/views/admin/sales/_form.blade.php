{{csrf_field()}}
<h5>Informações do cliente</h5>
<input type="hidden" id="client_id" name="client_id" value="{{old('client_id',!empty($sale->client_id) ? $sale->client_id : '')}}">
<div class="form-group">
    <label for="name">Nome do cliente</label>
    <input class="form-control" id="name" name="name" value="{{old('name', !empty($sale->client->name) ? $sale->client->name : '')}}" autocomplete="off" placeholder="Digite o nome do cliente" required>
</div>

<div class="form-group">
    <label for="email">E-mail</label>
    <input class="form-control" id="email" name="email" type="email" value="{{old('email',!empty($sale->client->email) ? $sale->client->email : '')}}"
           required>
</div>

<div class="form-group">
    <label for="cpf">CPF</label>
    <input class="form-control" id="cpf" name="cpf" type="number" minlength="11" maxlength="11" size="11"
           value="{{old('cpf',!empty($sale->client->cpf) ? $sale->client->cpf : '')}}" placeholder="Somente números" required>
</div>

<h5 class='mt-5'>Informações da venda</h5>
<div class="form-group">
    <label for="product_id">Produto</label>
    <select id="product_id" name="product_id" class="form-control" required>
        <option value="" selected>Escolha...</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}"
                {{old('product_id',$product->id) == (!empty($sale->product->id) ? $sale->product->id : '' ) ? 'selected="selected"': ''}}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="date_sale">Data</label>
    <input type="text" class="form-control single_date_picker" id="date_sale" name="date_sale"
           value="{{old('date_sale', !empty($sale->date_sale) ? date( 'd/m/Y' , strtotime($sale->date_sale)) : '')}}" required>
</div>
<div class="form-group">
    <label for="qtd_product">Quantidade</label>
    <input class="form-control" id="qtd_product" name="qtd_product" type="number" min="1" max="10" step="1"
           value="{{old('qtd_product',!empty($sale->qtd_product) ? $sale->qtd_product : '')}}" placeholder="1 a 10"required>
</div>

<div class="form-group">
    <label for="discount">Desconto</label>
    <input class="form-control" id="discount" name="discount" type="number" min="0.00" max="100.00" step="0.01"
           value="{{old('price', !empty($sale->discount) ? $sale->discount : '')}}" placeholder="100,00 ou menor" required/>
</div>

@php
    $status = \App\Sale::STATUS;
    $aprovado = \App\Sale::APROVADO;
    $cancelado = \App\Sale::CANCELADO;
    $devolvido = \App\Sale::DEVOLVIDO;
@endphp

<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" name="status" id="status">
        <option value="">Escolha...</option>
        <option value="{{ $aprovado }}" {{old('status',!empty($sale->status) ? $sale->status : '') == $aprovado ?'selected="selected"': ''}}>{{ $status[$aprovado] }}</option>
        <option value="{{$cancelado}}" {{old('status', !empty($sale->status) ? $sale->status : '') == $cancelado ?'selected="selected"': ''}}>{{ $status[$cancelado] }}</option>
        <option value="{{$devolvido}}" {{old('status', !empty($sale->status) ? $sale->status : '') == $devolvido ?'selected="selected"': ''}}>{{ $status[$devolvido] }}</option>
    </select>
</div>
