<div class="form-row">
    <div class="form-group col-md-8">
        <label for="inputCity">Nome Completo</label>
        <input type="text" class="form-control" id="inputCity" value="{{ optional($user)->name }}">
    </div>
    <div class="form-group col-md-4">
        <label for="inputState">Categoria de usuário</label>
        <select id="inputState" class="form-control">
            <option>Selecione...</option>
            <option value="salesman" @if( optional(optional($user)->roles[0])->name == "salesman") selected @endif>REPRESENTANTE/VENDEDOR</option>
            <option value="customer" @if( optional(optional($user)->roles[0])->name == "customer") selected @endif>CLIENTE</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputCity">Nickname/Login</label>
        <input type="text" class="form-control" id="inputCity" value="{{ optional($user)->nickname }}">
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" value="{{ optional($user)->email }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password">
    </div>
</div>