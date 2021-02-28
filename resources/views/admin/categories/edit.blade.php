@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <h3 class="card-title">Editar Categoria</h3>
            </div>
            <div class="card-body">
                @include('admin.alerts.alerts')    
                {!!Form::model($category, ['route' => ['categories.update', $category->id], 'class' => 'form'])!!}
                    @method('PUT')
                    @include('admin.categories._partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@stop
