@extends('layout')
@section('title')
    Vendas
@endsection
@section('content')
    @php
        $status = \App\Sale::STATUS;
        $aprovado = \App\Sale::APROVADO;
        $cancelado = \App\Sale::CANCELADO;
        $devolvido = \App\Sale::DEVOLVIDO;
    @endphp
    <h3>Ver vendas</h3>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-1">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('sales.edit',['sale' => $sale->id]) }}">Editar</a>
                <a class="btn btn-danger float-right btn-sm rounded-pill" href="{{ route('sales.destroy',['sale' => $sale->id]) }}"
                   onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
            </h5>
            <form id="form-delete" style="display: none"
                  action="{{ route('sales.destroy',['sale' => $sale->id]) }}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            </form>
            <br/><br/>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$sale->id}}</td>
                </tr>
                <tr>
                    <th scope="row">CLiente</th>
                    <td>{{$sale->client->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Produto</th>
                    <td>{{$sale->product->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Data</th>
                    <td>{{ !empty($sale->date_sale) ? date( 'd/m/Y' , strtotime($sale->date_sale)) : ''}}</td>
                </tr>
                <tr>
                    <th scope="row">Quantidade</th>
                    <td>{{ $sale->qtd_product }}</td>
                </tr>
                <tr>
                    <th scope="row">Preço</th>
                    <td>{{'R$ '.number_format((($sale->qtd_product * $sale->product->price) - $sale->discount), 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <th scope="row">Desconto</th>
                    <td>{{'R$ '.number_format($sale->discount, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>{{ $status[$aprovado] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
