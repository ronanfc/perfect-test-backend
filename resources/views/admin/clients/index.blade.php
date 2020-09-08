@extends('layout')

@section('title')
Clientes
@endsection
@section('content')
    <h1>Lista de Clientes</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">
                <a class="btn btn-secondary float-right btn-sm rounded-pill" href="{{ route('clients.create') }}"><i class='fa fa-plus'></i> Novo Cliente</a>
            </h5>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->cpf }}</td>
                        <td width="22%">
                            <a href="{{route('clients.show',['client' => $client->id])}}">Ver</a> |
                            <a href="{{route('clients.edit',['client' => $client->id])}}">Editar</a> |
                            <a href="{{ route('clients.destroy',['client' => $client->id]) }}" onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
                            <form id="form-delete" style="display: none"
                                  action="{{ route('clients.destroy',['client' => $client->id]) }}" method="post">
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
        {{$clients->links()}}
@endsection
