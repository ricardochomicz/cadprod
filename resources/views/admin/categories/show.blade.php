@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')

    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h5>
                    <i class="fas fa-tags mr-2"></i> {{ $category->title }}
                    <small class="float-right">Criado em: {{ $category->created_at->format('d/m/Y') }}</small>
                </h5>
            </div>
            <!-- /.col -->
        </div>
        <hr>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    URL: <strong>{{ $category->url }}</strong><br>
                    Descrição: <strong>{{ $category->description }}</strong>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- this row will not appear when printing -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-default"><i
                        class="fas fa-arrow-circle-left"></i> Voltar</a>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Deletar</button>
                </form>
            </div>
        </div>
    @stop
