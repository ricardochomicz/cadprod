@csrf
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Usuário</label>
            {{ Form::text('user_id', Auth::user()->id . ' - ' . Auth::user()->name, ['placeholder' => 'Usuário', 'class' => 'form-control', 'readonly']) }}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">ID Ordem</label>
            {{ Form::text('identify', null, ['placeholder' => 'ID Ordem', 'class' => 'form-control', 'readonly']) }}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Código Ordem</label>
            {{ Form::text('code', null, ['placeholder' => 'Código', 'class' => 'form-control', 'readonly']) }}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Data Venda</label>
            {{ Form::date('date', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="">Produto</label>
            {{ Form::select('product_id', $products, null, ['class' => 'form-control select2']) }}
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="">Qtd</label>
            {{ Form::text('qty', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Preço</label>
            {{ Form::text('price', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Total Ordem</label>
            {{ Form::text('total', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="">Status Venda</label>
            {{ Form::select('status', $status, null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="">Método de Pagamento</label>
            {{ Form::select('payment_method', $payments, null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
</div>
