const Swal = require('sweetalert2');

function editUser( id ) {
	console.log('editUser function');

    const modal = $('#userEditModal');
    const url = '/admin/usuarios/'+id+'/edit';

    $.get( url )
        .done(function( response ) {
           $('#userEditModal .modal-content').html( response );
           modal.modal('show');
        });
}


$('.editUser').click(function(event) {
    editUser( $(this).attr('id') );
})

$('.deleteUser').click(function(event){
	const swalWithBootstrapButtons = Swal.mixin({
	  customClass: {
	    confirmButton: 'btn btn-success',
	    cancelButton: 'btn btn-danger'
	  },
	  buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonText: 'Yes, delete it!',
	  cancelButtonText: 'No, cancel!',
	  reverseButtons: true
	}).then((result) => {
	  if (result.value) {
	    swalWithBootstrapButtons.fire(
	      'Deleted!',
	      'Your file has been deleted.',
	      'success'
	    )
	  } else if (
	    /* Read more about handling dismissals below */
	    result.dismiss === Swal.DismissReason.cancel
	  ) {
	    swalWithBootstrapButtons.fire(
	      'Cancelled',
	      'Your imaginary file is safe :)',
	      'error'
	    )
	  }
	})
})
