@extends('adminlte::page')

@section('title', 'Novo Produto')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <h3 class="card-title">Cadastro de Novo Produto</h3>
            </div>
            <div class="card-body">
                @include('admin.alerts.alerts')    
               
                    {!! Form::open(['route' => 'products.store', 'class' => 'form'])!!}
                    @include('admin.products._partials.form')
                    {!! Form::close() !!}
               
            </div>
        </div>
    </div>
    
@stop
