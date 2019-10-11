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
            body +=     '<td data-th="Product">';
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
            body +=     '<td data-th="Price">R$ '+price+'</td>';
            body +=     '<td data-th="Quantity">';
            body +=         '<input type="hidden" name="items[]" value="'+id+'">'
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
