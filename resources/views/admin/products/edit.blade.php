@extends('layout')
@section('title')
    Produtos
@endsection
@section('content')
    <h3>Editar produto</h3>
    <div class='card mt-3'>
        <div class='card-body'>
            @include('form._form_errors')
            @include('form._help_block')
            <form method="post" action="{{ route('products.update',['product' => $product->id]) }}"
                  enctype="multipart/form-data">
                {{method_field('PUT')}}
                @include('admin.products._form')
                <button type="submit" class="btn btn-secondary float-right btn-sm rounded-pill">Salvar</button>
            </form>
        </div>
    </div>
@endsection
