<form action="/admin/usuarios" method="POST">
    @csrf

    @include('admin.users._form', [
        'category' => $category,
        'isUpdate' => false
    ])
</form>