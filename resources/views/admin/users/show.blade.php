@extends('adminlte::page')

@section('title', 'Detalhes Usuário')

@section('content_header')
    <h1>Usuário</h1>
@stop

@section('content')

    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h5>
                    <i class="fas fa-tags mr-2"></i> {{ $user->name }}
                    <small class="float-right">Criado em: {{ $user->created_at->format('d/m/Y') }}</small>
                </h5>
            </div>
            <!-- /.col -->
        </div>
        <hr>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    E-mail: <strong>{{ $user->email }}</strong><br>
                    Status: <strong>@if($user->status == 1) Ativo @else Inativo @endif</strong><br>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- this row will not appear when printing -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar</button>
                </form>
            </div>
        </div>
    @stop
