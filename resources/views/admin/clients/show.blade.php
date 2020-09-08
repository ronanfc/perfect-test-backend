@extends('layout')
@section('title')
    Clientes
@endsection
@section('content')
    <h3>Ver cliente</h3>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-1">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('clients.edit',['client' => $client->id]) }}">Editar</a>
                <a class="btn btn-danger float-right btn-sm rounded-pill" href="{{ route('clients.destroy',['client' => $client->id]) }}"
                   onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
            </h5>
            <form id="form-delete" style="display: none"
                  action="{{ route('clients.destroy',['client' => $client->id]) }}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            </form>
            <br/><br/>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$client->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$client->name}}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{$client->email}}</td>
                </tr>
                <tr>
                    <th scope="row">CPF</th>
                    <td>{{$client->cpf}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
