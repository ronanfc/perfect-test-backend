@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form method="post" action="{{ route('reportSales') }}">
                {{csrf_field()}}
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName" name="inlineFormInputName" required>
                                <option value="">Clientes</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" name="inlineFormInputGroupUsername" placeholder="Período" required>
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table' id="dashboardTable">
                <thead>
                <tr>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td>
                        {{$sale->product->name}}
                    </td>
                    <td>
                        {{ !empty($sale->date_sale) ? date( 'd/m/Y' , strtotime($sale->date_sale)) : ''}}
                    </td>
                    <td>
                        {{'R$ '.number_format($sale->product->price, 2, ',', '.')}}
                    </td>
                    <td>
                        <a class='btn btn-primary' href="{{route('sales.edit',['sale' => $sale->id])}}">Editar</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Valor Total
                    </th>
                </tr>
                <tr>
                    <td>
                        Vendidos
                    </td>
                    <td>
                        100
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('products.create') }}"><i class='fa fa-plus'></i> Novo Produto</a>
            </h5>
            <table class="table table-striped" id="indexTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if(!empty($product->img_src))
                                <img src="
                                {{ filter_var($product->img_src, FILTER_VALIDATE_URL)? $product->img_src : asset('products/'.$product->img_src) }}"
                                     width="50">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{'R$ '.number_format($product->price, 2, ',', '.')}}</td>
                        <td width="22%">
                            <a href="{{route('products.show',['product' => $product->id])}}">Ver</a> |
                            <a href="{{route('products.edit',['product' => $product->id])}}">Editar</a> |
                            <a href="{{ route('products.destroy',['product' => $product->id]) }}"
                               onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
                            <form id="form-delete" style="display: none"
                                  action="{{ route('products.destroy',['product' => $product->id]) }}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection