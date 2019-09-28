<div class="row">
    <div class="form-group col-sm-12">
        <label for="name">Nome</label>
        <input class="form-control" name="name" id="name" value="{{ optional($category)->name }}" required>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar dados</button>
    </div>
</div>