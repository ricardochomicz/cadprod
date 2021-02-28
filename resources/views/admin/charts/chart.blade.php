@extends('adminlte::page')

@section('title', 'Relatório Mensal de Vendas')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Relatório Mensal de Vendas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{route('reports.months')}}">Gráficos</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="card card-outline card-secondary ">
            <div class="card-header">
                
            </div>
           
            <div class="card-body table-responsive p-0">
                
                {!!$chart->container()!!}
              
            </div>
        </div>
    </div>
@stop

@push('js')
    {!! $chart->script() !!}
@endpush
