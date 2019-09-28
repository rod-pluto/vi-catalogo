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

$('#categories-table').DataTable();

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

/** Funções de crud */
function editProduct( product_id, btn ) {
    var url = '/admin/produtos';
    const modal = $('#genericModal');
    btn = $(btn);

    $.get(url + '/' + product_id)
     .done(function( response ) {
        $('#genericModal .modal-title').html( 'Edição de Produto' );
        $('#genericModal .modal-body').html( response );
        btn.button('reset');
        modal.modal('show');
     })
     .fail(function( response ) {
        btn.button('reset');
        alert('deu tiuti');
     });
}

function showProduct( product_id, btn ) {
   var url = '/admin/produtos';
   const modal = $('#genericModal');

   $.get(url + '/' + product_id)
      .done(function( response ) {
         $('#genericModal .modal-body').html( response );
         modal.modal('show');
      })
      .fail(function( response ) {
        alert('deu tiuti');
      });
}

function deleteProduct( product_id, btn ) {

}

/** EVENTOS */

$('#products-table').DataTable();

$('.edit-product').click(function(){
   $(this).button('loading');
    console.log( $(this).attr('product-id'));
    editProduct( $(this).attr('product-id'), $(this) );
});

$('.show-product').click(function(){
   $(this).button('loading');
   console.log( $(this).attr('product-id'));
   showProduct( $(this).attr('product-id'), $(this) );
});

$('.delete-product').click(function(){
   $(this).button('loading');
   console.log( $(this).attr('product-id'));
   deleteProduct( $(this).attr('product-id'), $(this) );
});

/** Funções de crud */
function editUser( user_id, btn ) {
    var url = '/admin/usuarios';
    const modal = $('#genericModal');
    btn = $(btn);

    $.get(url + '/' + user_id)
     .done(function( response ) {
        $('#genericModal .modal-body').html( response );
        btn.button('reset');
        modal.modal('show');
     })
     .fail(function( response ) {
        btn.button('reset');
        alert('deu tiuti');
     });
}

function showUser( user_id, btn ) {
   var url = '/admin/usuarios';
   const modal = $('#genericModal');

   $.get(url + '/' + user_id)
      .done(function( response ) {
         $('#genericModal .modal-body').html( response );
         modal.modal('show');
      })
      .fail(function( response ) {
        alert('deu tiuti');
      });
}

function deleteUser( user_id, btn ) {

}

/** EVENTOS */

$('#users-table').DataTable();

$('.edit-user').click(function(){
   $(this).button('loading');
    console.log( $(this).attr('user-id'));
    editUser( $(this).attr('user-id'), $(this) );
});

$('.show-user').click(function(){
   $(this).button('loading');
   console.log( $(this).attr('user-id'));
   showUser( $(this).attr('user-id'), $(this) );
});

$('.delete-user').click(function(){
   $(this).button('loading');
   console.log( $(this).attr('user-id'));
   deleteUser( $(this).attr('user-id'), $(this) );
});
