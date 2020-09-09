@extends('layout')
@section('title')
    Produtos
@endsection
@section('content')
    <h3>Ver produto</h3>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-1">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('products.edit',['product' => $product->id]) }}">Editar</a>
                <a class="btn btn-danger float-right btn-sm rounded-pill" href="{{ route('products.destroy',['product' => $product->id]) }}"
                   onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
            </h5>
            <form id="form-delete" style="display: none"
                  action="{{ route('products.destroy',['product' => $product->id]) }}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            </form>
            <br/><br/>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$product->id}} </td>
                </tr>
                <tr>
                    <th scope="row">Imagem</th>
                    <td>
                        @if(!empty($product->img_src))
                            <img src="
                                {{ filter_var($product->img_src, FILTER_VALIDATE_URL)? $product->img_src : asset('img/products/'.$product->img_src) }}"
                                 width="100">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$product->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$product->description}}</td>
                </tr>
                <tr>
                    <th scope="row">Preço</th>
                    <td>{{'R$ '.number_format($product->price, 2, ',', '.')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
