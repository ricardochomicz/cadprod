@extends('adminlte::page')

@section('title', 'Nova Venda')

@section('content_header')
    <h1>Ordens</h1>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <h3 class="card-title">Nova Venda</h3>
            </div>
            <div class="card-body">
                @include('admin.alerts.alerts')    
                    {!! Form::open(['route' => 'orders.store', 'class' => 'form'])!!}
                    @include('admin.orders._partials.form')
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@stop
