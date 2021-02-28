@extends('adminlte::page')

@section('title', 'Nova Categoria')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <h3 class="card-title">Cadastro de Nova Categoria</h3>
            </div>
            <div class="card-body">
                @include('admin.alerts.alerts')    
               
                    {!! Form::open(['route' => 'categories.store', 'class' => 'form'])!!}
                    @include('admin.categories._partials.form')
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@stop
