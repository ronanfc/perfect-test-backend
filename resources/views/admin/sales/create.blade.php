@extends('layout')
@section('title')
    Vendas
@endsection
@section('content')
    <h3>Nova venda</h3>
    <div class='card mt-3'>
        <div class='card-body'>
            @include('form._form_errors')
            <form method="post" action="{{ route('sales.store') }}">
                @include('admin.sales._form')
                <button type="submit" class="btn btn-secondary float-right btn-sm rounded-pill">Salvar</button>
            </form>
        </div>
    </div>
@endsection
