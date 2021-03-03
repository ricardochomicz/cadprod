@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Nome</label>
            {{ Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">E-mail</label>
            {{ Form::text('email', null, ['placeholder' => 'E-mail', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="">Status</label>
            {{ Form::select('status', [1 => 'Ativo', 2 => 'Inativo'], null, ['class' => 'form-control']) }}
        </div>
    </div>
    
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary" swalDefaultError>Salvar</button>
</div>
