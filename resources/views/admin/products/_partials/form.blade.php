@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Título</label>
                {{ Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label for="">Categoria</label>
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Preço</label>
            {{ Form::text('price', null, ['placeholder' => 'Preço', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            {{ Form::textarea('description', null, ['placeholder' => 'Descrição', 'class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
</div>
