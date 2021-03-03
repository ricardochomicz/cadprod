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
                <div class="card-tools">
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-default">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                @include('admin.alerts.alerts')    
                {!!Form::model($order, ['route' => ['orders.update', $order->id], 'class' => 'form'])!!}
                    @method('PUT')
                    @include('admin.orders._partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@stop
