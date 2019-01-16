<!-- Modal -->
<div class="modal fade" id="myModal-{{$laboratoryTest->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          {{ strtoupper($laboratoryTest->charge->code) .': Record ID:' . $laboratoryTest->record->id . ' ( ' . ucfirst($laboratoryTest->record->user->first_name) . ' ' . ucfirst($laboratoryTest->record->user->middle_name) . ' ' . ucfirst($laboratoryTest->record->user->last_name) . ' )' }}
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form action="{{ route('laboratoryTests.destroy', $laboratoryTest) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>