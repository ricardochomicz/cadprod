@extends('adminlte::page')

@section('title', 'Listagem de Ordens')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Ordens de Venda</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Ordens</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                <form action="{{ route('categories.search') }}" class="form-inline float-left" method="POST">
                    @csrf
                    <input type="search" name="title" class="form-control form-control-sm mr-1" placeholder="Título"
                        value="{{ $data['title'] ?? '' }}">
                    <input type="search" name="url" class="form-control form-control-sm mr-1" placeholder="URL"
                        value="{{ $data['url'] ?? '' }}">
                    <button class="btn btn-sm btn-secondary" type="submit"><i class="fas fa-search mr-1"></i>
                        Filtrar</button>
                </form>


                <div class="card-tools">
                    <a href="{{ route('orders.create') }}" class="btn btn-sm btn-secondary">Novo</a>
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
                            <th>ID Venda</th>
                            <th>Data</th>
                            <th>Status Venda</th>
                            <th>Método Pagamento</th>
                            <th>Total</th>
                            <th>Usuário</th>
                            <th width="200px" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">{{ $order->identify }}</td>
                                <td class="align-middle">{{ $order->dateFormat($order->date) }}</td>
                                <td class="align-middle">
                                    @switch($order->status)
                                        @case(1)
                                          Aguardando Pagamento
                                          @break
                                        @case(2)
                                          Teste2
                                          @break
                                        @case(3)
                                          Teste3
                                          @break
                                        @default
                                    @endswitch
                                </td>
                                <td class="align-middle">
                                  @switch($order->payment_method)
                                      @case(1)
                                        Dinheiro
                                        @break
                                      @case(2)
                                        Cartão Débito
                                        @break
                                      @case(3)
                                        Cartão Crédito
                                        @break
                                      @case(4)
                                        Boleto
                                        @break  
                                      @default
                                  @endswitch
                              </td>
                              <td class="align-middle">R$ {{ number_format($order->total, 2, ',', '.') }}</td>
                                <td class="align-middle">{{ $order->user->name }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fas fa-pen"></i> Editar</a>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-search"></i> Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="pagination pagination-sm p-2">

                </ul>
            </div>
        </div>
    </div>
@stop
