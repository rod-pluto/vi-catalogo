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

function deleteProduct( prod_id ) {
    if (
        confirm('Você tem certeza dessa ação ?')
    ) {
        $('#delete-product-form').attr('action', '/admin/produtos/'+prod_id);
        $('#delete-product-form').submit();
    }
}

function eanPicker() {
    var url = '/admin/produtos';
    const modal = $('#eanModal');
    modal.modal('show');
}

/** EVENTOS */

$('#products-table').DataTable({
    language: {
        'url': 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json'
    }
});

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
