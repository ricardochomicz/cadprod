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
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Senha</label>
            {{ Form::text('password', null, ['placeholder' => 'Senha', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mt-1">
            <label for="">Status</label>
            <div class="form-check ml-0">
                {!! Form::checkbox('status', 1, null) !!}
                <label class="form-check-label ml-2" for="flexCheckChecked">
                    @if($user->status) Ativo @else Inativo @endif
                </label>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary" swalDefaultError>Salvar</button>
</div>
