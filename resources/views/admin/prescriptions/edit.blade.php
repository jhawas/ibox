@extends('admin.layouts.app')

@section('content')
    <div class="app-title">
      <div>
          <h1><i class="fa fa-dashboard"></i> {{ $page }}</h1>
          <p>{{ $description }}</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">{{ $page }}</a></li>
      </ul>
    </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Prescription Form</h3>
            <form method="POST" action="{{ route('prescriptions.update', $prescription) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Patient Record</label>
                    <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                      <option selected value="0">Choose Patient</option>
                      @foreach ($patientRecords as $patientRecord)
                        <option {{ $prescription->patient_record_id == $patientRecord->id ? 'selected' : '' }} value="{{ $patientRecord->id }}">
                          {{ 'Record ID:' . $patientRecord->id . ' ( ' . ucfirst($patientRecord->user->first_name) . ' ' . ucfirst($patientRecord->user->middle_name) . ' ' . ucfirst($patientRecord->user->last_name) . ' )'}}
                        </option>
                      @endforeach
                    </select>
                    @if ($errors->has('patientRecord'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('patientRecord') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description/Note</label>
                    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      placeholder="Enter Description here...">{{$prescription->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                  @if(Auth::user()->user_role->role->id == 4 || Auth::user()->user_role->role->id == 5 || Auth::user()->user_role->role->id == 1 || Auth::user()->user_role->role->id == 2)
                    <div class="form-check">
                      <label class="form-check-label">
                        <input 
                          name="is_approved" 
                          class="form-check-input" 
                          type="checkbox"
                          {{ $prescription->is_approved == 1 ? 'checked' : '' }}
                        >presciption approved
                      </label>
                    </div>
                  @endif
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('prescriptions.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection