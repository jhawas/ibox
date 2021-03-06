<!-- Modal -->
<div class="modal fade" id="myModal-{{$intravenousFluid->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ 'Record ID:' . $intravenousFluid->record->id . ' ( ' . ucfirst($intravenousFluid->record->patient->first_name) . ' ' . ucfirst($intravenousFluid->record->patient->middle_name) . ' ' . ucfirst($intravenousFluid->record->patient->last_name) . ' )' }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form action="{{ route('intravenousFluids.destroy', $intravenousFluid) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>