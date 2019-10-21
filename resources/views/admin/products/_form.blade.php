<div class="row">
    <div class="col-sm-6">
        <div class="thumbnail">
            <img src="@if( $product != null) {{ $product->image }} @else https://via.placeholder.com/800 @endif" alt="...">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control select2js" name="category_id" id="category_id" required>
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
        <div class="form-group">
            <label for="ean">EAN</label>
            <div class="input-group">
                <input class="form-control" name="ean" id="ean" value="{{ optional($product)->ean }}" required>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" onclick="eanPicker()">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="url">Url</label>
            <input class="form-control" name="image" id="url" value="{{ optional($product)->image }}" required>
        </div>

        <div class="form-group">
            <label for="name">Nome</label>
            <input class="form-control" name="name" id="name" value="{{ optional($product)->name }}" required>
        </div>

        <div class="row">
            <div class="form-group col-sm-5">
                <label for="und">Unidade</label>
                <input class="form-control" name="und" id="und" value="{{ optional($product)->und }}" required>
            </div>
            <div class="form-group col-sm-7">
                <label for="price">Preço</label>
                <div class="input-group">
                    <span class="input-group-addon" >R$</span>
                    <input class="form-control" name="price" id="price" value="{{ number_format(optional($product)->price, 2, ',', '.') }}" required>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="form-group col-sm-12">
        <label for="description">Descrição</label>
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
