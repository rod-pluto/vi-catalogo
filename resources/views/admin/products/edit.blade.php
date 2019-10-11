<form action="/admin/produtos/{{ $product->id }}" method="POST">
    @csrf
    {{ method_field('PUT') }}

    @include('admin.products._form', [
        'product' => $product,
        'categories' => $categories,
        'companies' => $companies,
        'isUpdate' => true
    ])
</form>
