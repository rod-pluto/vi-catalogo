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
