@extends('adminlte::page')

@section('title', 'Listagem de Produtos')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Produtos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produtos</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <form action="{{ route('products.search') }}" class="form-inline float-left" method="POST">
                    @csrf
                    
                    <input type="search" name="name" class="form-control form-control-sm mr-1" placeholder="Produto"
                        value="{{ $data['name'] ?? '' }}">
                    <input type="search" name="price" class="form-control form-control-sm mr-1" placeholder="Preço"
                        value="{{ $data['price'] ?? '' }}">
                    <select name="category" class="form-control form-control-sm mr-1">
                        <option value="">Categorias</option>
                        @foreach ($categories as $key => $cat)
                            <option value="{{ $key }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-secondary" type="submit"><i class="fas fa-search mr-1"></i>
                        Filtrar</button>
                </form>


                <div class="card-tools">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-secondary">Novo</a>
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
                            <th>Título</th>
                            <th>Slug</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th width="200px" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="align-middle">{{ $product->id }}</td>
                                <td class="align-middle">{{ $product->name }}</td>
                                <td class="align-middle">{{ $product->url }}</td>
                                <td class="align-middle">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="align-middle">{{ $product->category->title }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-pen"></i> Editar</a>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-search"></i> Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="pagination pagination-sm p-2">
                    @if (isset($data))
                        {!! $products->appends($data)->links('pagination::bootstrap-4') !!}
                    @else
                        {!! $products->links('pagination::bootstrap-4') !!}
                    @endif
                </ul>
            </div>
        </div>
    </div>
@stop
