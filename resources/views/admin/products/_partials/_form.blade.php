@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Título</label>
            <input type="text" class="form-control form-control-sm" name="name"
                value="{{ $product->name ?? old('name') }}">
        </div>
        <div class="form-group">
            <label for="">Categoria</label>
            <select name="category_id" class="form-control form-control-sm">
                <option value="">Selecione</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if(isset($product->category_id) && $category->id == $product->category_id) selected @endif
                        >{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" class="form-control form-control-sm" name="price"
                value="{{ $product->price ?? old('price') }}">
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <textarea name="description"
                class="form-control">{{ $product->description ?? old('description') }}</textarea>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
</div>
