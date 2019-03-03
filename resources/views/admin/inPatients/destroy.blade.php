<!-- Modal -->
<div class="modal fade" id="myModal-{{$inPatient->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Patient: {{ ucfirst($inPatient->patient->first_name) . ' ' . ucfirst($inPatient->patient->middle_name) . ' ' . ucfirst($inPatient->patient->last_name) }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form action="{{ route('inPatients.destroy', $inPatient) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>