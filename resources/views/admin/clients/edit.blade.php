@extends('layout')
@section('title')
    Clientes
@endsection
@section('content')
    <h3>Editar cliente</h3>
    <div class='card mt-3'>
        <div class='card-body'>
    @include('form._form_errors')
    <form method="post" action="{{ route('clients.update',['client' => $client->id]) }}">
        {{method_field('PUT')}}
        @include('admin.clients._form')
        <button type="submit" class="btn btn-secondary float-right btn-sm rounded-pill">Salvar</button>
    </form>
        </div>
    </div>
@endsection
