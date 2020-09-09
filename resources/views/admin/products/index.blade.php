@extends('layout')
@section('title')
    Produtos
@endsection
@section('content')
    <h1>Lista de Produtos</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('products.create') }}"><i class='fa fa-plus'></i> Novo Produto</a>
            </h5>
            @include('form._help_block')
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
                                <img src="{{ filter_var($product->img_src, FILTER_VALIDATE_URL)? $product->img_src : asset('img/products/'.$product->img_src) }}"
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
