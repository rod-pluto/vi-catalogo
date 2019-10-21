function modalAddItem( item ) {
    var url = '/cliente/catalogo';
    const modal = $('#genericModal');

    $.get(url + '/' + item + '/adicionar-item')
        .done(function( response ) {
            $('#genericModal .modal-body').html( response );
            modal.modal('show');
        })
        .fail(function( response ) {
            console.log( response );
            alert( 'deu tiuti' );
        });
}

function addItemToShoppingCart(id, name, description, quantity, price, image) {
    item = [id, name, description, quantity, price, image];

    // verifica se já existe valores no session storage
    if ( window.sessionStorage.getItem('items') ) {
        items = window.sessionStorage.getItem('items');
        items = JSON.parse(items);
        items.push(item);
        // atualizando contador
        $('#spccounter').html( items.length );
        window.sessionStorage.setItem('items', JSON.stringify(items));
        console.log(items);
    } else {
        window.sessionStorage.setItem('items', JSON.stringify([item]));
    }

    const modal = $('#genericModal');
    modal.modal('hide');
    alert(name + ' adicionado ao carrinho');

}

function updateTable() {

    if ( window.sessionStorage.getItem('items') ) {
        items = window.sessionStorage.getItem('items');
        items = JSON.parse(items);

        total = 0;

        html = "";
        for (cont=0; cont < items.length; cont++) {
            id          = items[cont][0];
            name        = items[cont][1];
            description = items[cont][2];
            quantity    = items[cont][3];
            price       = items[cont][4];
            image       = items[cont][5];


            body =  '<tr id="row-'+id+'">';
            body +=     '<td data-th="Produtos">';
            body +=         '<div class="row">';
            body +=             '<div class="col-sm-2 hidden-xs">';
            body +=                 '<img src="'+image+'" alt="..." class="img-responsive"/>';
            body +=             '</div>';
            body +=             '<div class="col-sm-10">';
            body +=                 '<h4 class="nomargin">'+name+'</h4>';
            body +=                 '<p>'+description+'</p>';
            body +=             '</div>';
            body +=         '</div>';
            body +=     '</td>';
            body +=     '<td data-th="Preço">R$ '+price+'</td>';
            body +=     '<td data-th="Quantidade">';
            body +=         '<input type="hidden" name="items[]" value="'+id+'">';
            body +=         '<input type="number" class="form-control text-center quantity" name="quantity[]" onChange="updateItemTable('+cont+', this)" value="'+quantity+'">';
            body +=     '</td>';
            body +=     '<td data-th="Subtotal" class="text-center">'+parseFloat((quantity * price).toFixed(2))+'</td>';
            body +=     '<td class="actions" data-th="">';
            body +=          '<button type="button" class="btn btn-danger btn-sm" onclick="deleteItem('+id+','+cont+',this)"><i class="fa fa-fw fa-trash-alt"></i></button>';
            body +=      '</td>';
            body += '</tr>';

            html += body;

            total += parseFloat((quantity * price).toFixed(2));
            $('.total-price').html('Total R$ '+ total.toFixed(2));
        }
    } else {
        console.log('num tem nada');
        html = "";
        body =  '<tr><td class="text-center" colspan="5">Sem produtos adicionados ao carrinho...</td></tr>';
        html += body;

        if ( $('.total-price').length ) {
            ('.total-price').html('Total R$ 0,00');
        }
    }

    $('#cart tbody').html( html );
}

function updateItemTable(index, ref) {
    items = window.sessionStorage.getItem('items');
    items = JSON.parse(items);
    items[index][3] = $(ref).val();
    window.sessionStorage.setItem('items', JSON.stringify(items));
    updateTable();
}

function deleteItem( item,index, ref ) {
    items = window.sessionStorage.getItem('items');
    items = JSON.parse(items);
    items.splice(index, 1);
    window.sessionStorage.setItem('items', JSON.stringify(items));
    $('#row-'+item).remove();
    updateTable();
}

function processOrder() {
    // zerar os dados do carrinho
    window.sessionStorage.removeItem('items');
    $('#checkout-table #checkout-form').submit();
}

// ações e eventos globais;
if ( window.sessionStorage.getItem('items') ) {
    items = window.sessionStorage.getItem('items');
    items = JSON.parse(items);
    // atualizando contador
    $('#spccounter').html( items.length );
}

updateTable();

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

function deleteUser( user_id ) {
    if (
        confirm('Você tem certeza dessa ação ?')
    ) {
        $('#delete-user-form').attr('action', '/admin/usuarios/'+user_id);
        $('#delete-user-form').submit();
    }
}

/** EVENTOS */
$('#users-table').DataTable({
    language: {
        'url': 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json'
    }
});

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
