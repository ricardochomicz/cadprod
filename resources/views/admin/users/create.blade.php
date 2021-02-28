@extends('adminlte::page')

@section('title', 'Nova Usuário')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <h3 class="card-title">Cadastro de Novo Usuário</h3>
            </div>
            <div class="card-body">
                @include('admin.alerts.alerts')

                {!! Form::open(['route' => 'users.store', 'class' => 'form']) !!}
                @include('admin.users._partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
