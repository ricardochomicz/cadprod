@extends('adminlte::page')

@section('title', 'Detalhes Ordem')

@section('content_header')
    <h1>Ordem - {{ $order->identify }}</h1>
@stop

@section('content')

    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h5>
                    <i class="fas fa-tags mr-2"></i> {{ $order->code }}
                    <small class="float-right">Criado em:
                        {{ implode('/', array_reverse(explode('-', $order->date))) }}</small>
                </h5>
            </div>
            <!-- /.col -->
        </div>
        <hr>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    Status: <strong
                        class="{{ $order->status == 3 ? 'text-success' : '' }} {{ $order->status == 2 ? 'text-danger' : '' }}">
                        @switch($order->status)
                            @case(1)
                            Aguardando Pagamento
                            @break
                            @case(2)
                            Cancelado
                            @break
                            @case(3)
                            Pago
                            @break
                            @case(4)
                            Análise de Crédito
                            @break
                            @default
                        @endswitch
                    </strong><br>
                    Método Pagamento: <strong>
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
                    </strong><br>
                    Valor: <strong>R$ {{ number_format($order->total, 2, ',', '.') }}</strong><br>
                    Usuário: <strong>{{ $order->user->name }}</strong>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <table class="table table-borderless table-hover">
                <thead>
                    <tr class="table-active">
                        <th>Produto</th>
                        <th class="text-center">Qtd</th>
                        <th class="text-center">Preço Unit.</th>
                        <th class="text-center">SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $item)
                    @php
                        $sum = $item->pivot->price * $item->pivot->qty
                    @endphp
                        <tr>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle text-center">{{ $item->pivot->qty }}</td>
                            <td class="align-middle text-center">R$ {{ number_format($item->pivot->price, 2, ',', '.') }}</td>
                            <td class="align-middle text-center">R$ {{ number_format($sum, 2, ',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
        <!-- this row will not appear when printing -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-default"><i
                            class="fas fa-arrow-circle-left"></i> Voltar</a>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Deletar</button>
                </form>
            </div>
        </div>
    @stop
