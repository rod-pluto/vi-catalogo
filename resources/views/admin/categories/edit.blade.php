<form action="/admin/categorias/{{ $category->id }}" method="POST">
    @csrf
    {{ method_field('PUT') }}

    @include('admin.categories._form', [
        'category' => $category,
        'isUpdate' => true
    ])
</form>