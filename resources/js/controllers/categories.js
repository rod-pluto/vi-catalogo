/** Funções de crud */
function editCategory( category_id, btn ) {
    var url = '/admin/categorias';
    const modal = $('#genericModal');
    btn = $(btn);

    $.get(url + '/' + category_id)
     .done(function( response ) {
        $('#genericModal .modal-title').html( 'Edição de Categoria' );
        $('#genericModal .modal-body').html( response );
        btn.button('reset');
        modal.modal('show');
     })
     .fail(function( response ) {
        btn.button('reset');
        alert('deu tiuti');
     });
}

function showCategory( category_id, btn ) {
   var url = '/admin/categorias';
   const modal = $('#genericModal');

   $.get(url + '/' + category_id)
      .done(function( response ) {
         $('#genericModal .modal-body').html( response );
         modal.modal('show');
      })
      .fail(function( response ) {
        alert('deu tiuti');
      });
}

function deleteCategory( category_id, btn ) {

}

/** EVENTOS */

$('#categories-table').DataTable({
    language: {
        'url': 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json'
    }
});

$('.edit-category').click(function(){
   $(this).button('loading');
    console.log( $(this).attr('category-id'));
    editcategory( $(this).attr('category-id'), $(this) );
});

$('.show-category').click(function(){
   $(this).button('loading');
   console.log( $(this).attr('category-id'));
   showcategory( $(this).attr('category-id'), $(this) );
});

$('.delete-category').click(function(){
   $(this).button('loading');
   console.log( $(this).attr('category-id'));
   deleteCategory( $(this).attr('category-id'), $(this) );
});
