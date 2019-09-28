<form action="/admin/usuarios/{{ $user->id }}" method="POST">
    @csrf
    {{ method_field('PUT') }}

    @include('admin.users._form', [
        'user' => $user,
        'isUpdate' => true
    ])
</form>