@extends('layout')
@section('title')
    Produtos
@endsection
@section('content')
    <h1>Lista de Vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('sales.create') }}"><i class='fa fa-plus'></i> Nova Venda</a>
            </h5>
            @include('form._help_block')
            <table class="table table-striped" id="indexTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->client->name }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ !empty($sale->date_sale) ? date( 'd/m/Y' , strtotime($sale->date_sale)) : ''}}</td>
                        <td>{{'R$ '.number_format((($sale->qtd_product * $sale->product->price) - $sale->discount), 2, ',', '.')}}</td>
                        <td width="22%">
                            <a href="{{route('sales.show',['sale' => $sale->id])}}">Ver</a> |
                            <a href="{{route('sales.edit',['sale' => $sale->id])}}">Editar</a> |
                            <a href="{{ route('sales.destroy',['sale' => $sale->id]) }}"
                               onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
                            <form id="form-delete" style="display: none"
                                  action="{{ route('sales.destroy',['sale' => $sale->id]) }}" method="post">
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
