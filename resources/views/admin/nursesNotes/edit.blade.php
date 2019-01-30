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
            <h3 class="tile-title">Nurse Note Form</h3>
            <form method="POST" action="{{ route('nursesNotes.update', $nursesNote) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Patient Record</label>
                    <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                      <option selected value="0">Choose Patient</option>
                      @foreach ($patientRecords as $patientRecord)
                        <option {{ $nursesNote->patient_record_id == $patientRecord->id ? 'selected' : '' }} value="{{ $patientRecord->id }}">
                          {{ 'Record ID:' . $patientRecord->id . ' ( ' . ucfirst($patientRecord->patient->first_name) . ' ' . ucfirst($patientRecord->patient->middle_name) . ' ' . ucfirst($patientRecord->patient->last_name) . ' )'}}
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
                    <label class="control-label">Date</label>
                    <input name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{$nursesNote->date}}" type="date" placeholder="Enter date">
                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Time</label>
                    <input name="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" value="{{$nursesNote->time}}" type="time" placeholder="Enter time">
                    @if ($errors->has('time'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('time') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Focus</label>
                    <textarea name="focus" class="form-control{{ $errors->has('focus') ? ' is-invalid' : '' }}"
                      placeholder="Enter focus here...">{{$nursesNote->focus}}</textarea>
                    @if ($errors->has('focus'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('focus') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Action Response</label>
                    <textarea name="data_action_response" class="form-control{{ $errors->has('data_action_response') ? ' is-invalid' : '' }}"
                      placeholder="Enter data_action_response here...">{{$nursesNote->data_action_response}}</textarea>
                    @if ($errors->has('data_action_response'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('data_action_response') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('nursesNotes.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection