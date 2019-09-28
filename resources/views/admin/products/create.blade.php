<form action="/admin/usuarios" method="POST">
    @csrf

    @include('admin.users._form', [
        'user' => $user,
        'isUpdate' => false
    ])
</form>