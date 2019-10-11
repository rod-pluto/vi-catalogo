<form action="/admin/usuarios" method="POST">
    @csrf

    @include('admin.users._form', [
        'user' => $user,
        'product' => $product,
        'categories' => $categories,
        'companies' => null,
        'isUpdate' => false
    ])
</form>
