@extends('adminlte::page')

@section('title', 'Listagem de Usuários')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Usuários</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuários</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <form action="{{ route('users.search') }}" class="form-inline float-left" method="POST">
                    @csrf

                    <input type="search" name="name" class="form-control form-control-sm mr-1" placeholder="Usuário"
                        value="{{ $data['name'] ?? '' }}">
                    <button class="btn btn-sm btn-secondary" type="submit"><i class="fas fa-search mr-1"></i>
                        Filtrar</button>
                </form>


                <div class="card-tools">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-secondary">Novo</a>
                </div>

            </div>
            @if (isset($filter))
                <small class="d-block p-2">Resultados para: <b>{{ $filter }}</b></small>
            @endif
            <div class="card-body table-responsive p-0">
                @include('admin.alerts.alerts')
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr class="bg-navy">
                            <th>#</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th width="200px" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="{{ $user->status != 1 ? 'text-danger' : '' }}">
                                <td class="align-middle">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fas fa-pen"></i> Editar</a>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-search"></i> Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="pagination pagination-sm p-2">
                    @if (isset($data))
                        {!! $users->appends($data)->links('pagination::bootstrap-4') !!}
                    @else
                        {!! $users->links('pagination::bootstrap-4') !!}
                    @endif
                </ul>
            </div>
        </div>
    </div>
@stop
