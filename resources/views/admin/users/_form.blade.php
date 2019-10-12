<div class="row">
    <div class="form-group col-sm-12">
        <label for="role">Tipo</label>
        <select class="form-control" name="role" id="role" required>
            <option>Selecione o tipo</option>
            @hasrole('admin')
                <option
                    value="admin"
                    @if( optional(optional($user)->roles[0])->name == 'admin' ) selected @endif
                >Administrador</option>
                <option
                    value="company"
                    @if( optional(optional($user)->roles[0])->name == 'company' ) selected @endif
                >Empresa</option>
            @endhasrole
            @hasrole('company')
                <option
                    value="customer"
                    @if( optional(optional($user)->roles[0])->name == 'customer' ) selected @endif
                >Cliente</option>
            @endhasrole
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="name">Nome</label>
        <input class="form-control" name="name" id="name" value="{{ optional($user)->name }}" required>
    </div>

    <div class="form-group col-sm-12">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ optional($user)->email }}" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label for="password">Senha</label>
        <input type="password" class="form-control" name="password" id="password" @if( !$isUpdate ) required @endif>
    </div>
</div>

@if( !$isUpdate )
    <div class="row">
        <div class="form-group col-sm-12">
            <label for="password_confirmation">Confirme a senha</label>
            <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar dados</button>
    </div>
</div>

@if( Auth::user()->roles[0]->name == 'company' )
    <input type="hidden" name="company_id" value="{{ Auth::user()->id }}">
@endif
