<input type="hidden" name="company_id" value="{{ Auth::user()->id }}"/>
<input type="hidden" name="image" value="https://via.placeholder.com/200"/>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="category_id">Categoria</label>
        <select class="form-control" name="category_id" id="category_id" required>
            <option>Selecione o tipo</option>
            @foreach($categories as $category)
                <option 
                    value="{{ $category->id }}"
                    @if( optional(optional($product)->category)->id == $category->id ) selected @endif
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="ean">EAN</label>
        <input class="form-control" name="ean" id="ean" value="{{ optional($product)->ean }}" required>
    </div>

    <div class="form-group col-sm-12">
        <label for="name">Nome</label>
        <input class="form-control" name="name" id="name" value="{{ optional($product)->name }}" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="und">Unidade</label>
        <input class="form-control" name="und" id="und" value="{{ optional($product)->und }}" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="price">Preço</label>
        <input class="form-control" name="price" id="price" value="{{ optional($product)->price }}" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="description">Descricao</label>
        <textarea class="form-control" name="description" id="description" required>
            {{ optional($product)->description }}
        </textarea>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar dados</button>
    </div>
</div>