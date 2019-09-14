<div class="modal-header">
                <h5 class="modal-title" id="userEditModalLabel">
                	@if( $user->gender == 'F')
                		<i class="fa fa-fw fa-female"></i> 
                	@else
                		<i class="fa fa-fw fa-male"></i>
                	@endif
                	{{ $user->name }} # {{ $user->email }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
				    @csrf
				    @method('PUT')
				    @include('admin.users.form', [
				        'updating' => true,
				        'user' => $user
				    ])
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Salvar dados</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>

