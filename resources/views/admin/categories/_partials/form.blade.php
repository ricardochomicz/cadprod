@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Título</label>
            {{ Form::text('title', null, ['placeholder' => 'Título', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Descrição</label>
            {{ Form::textarea('description', null, ['placeholder' => 'Descrição', 'class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary" swalDefaultError>Salvar</button>
</div>
