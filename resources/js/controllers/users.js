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
