$('#users-table').DataTable();

function editUser( user_id ) {
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

$('.edit-user').click(function(){
    console.log( $(this).attr('user-id'));
    editUser( $(this).attr('user-id') );
});
