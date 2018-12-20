<!-- Modal -->
<div class="modal fade" id="myModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ ucfirst($user->name) }}</h4>
      </div>
      <div class="modal-body">
          Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form action="{{ route('users.destroy', $user) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>