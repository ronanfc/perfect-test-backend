@extends('layout')
@section('title')
    Clientes
@endsection
@section('content')
    <h3>Novo cliente</h3>
    <div class='card mt-3'>
        <div class='card-body'>
            @include('form._form_errors')
            <form method="post" action="{{ route('clients.store') }}">
                @include('admin.clients._form')
                <button type="submit" class="btn btn-secondary float-right btn-sm rounded-pill">Criar</button>
            </form>
        </div>
    </div>
@endsection
