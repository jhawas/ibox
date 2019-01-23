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
            <h3 class="tile-title">Patient Record Form</h3>
            <form method="POST" action="{{ route('patientRecords.update', $patientRecord) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Patient</label>
                    <select class="select2 form-control{{ $errors->has('patientInformation') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientInformation">
                      <option selected value="0">Choose Patient</option>
                      @foreach ($patientInformations as $patientInformation)
                        <option {{ $patientRecord->user_id == $patientInformation->id ? 'selected' : '' }} value="{{ $patientInformation->id }}">{{ ucfirst($patientInformation->first_name) . ' ' . ucfirst($patientInformation->middle_name) . ' ' . ucfirst($patientInformation->last_name) }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('patientInformation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('patientInformation') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Record Types</label>
                    <select class="form-control{{ $errors->has('recordType') ? ' is-invalid' : '' }}" style="width: 100%;" name="recordType">
                      <option selected value="0">Choose Record Type</option>
                      @foreach ($recordTypes as $recordType)
                        <option {{ $patientRecord->type_of_charge_id == $recordType->id ? 'selected' : '' }} value="{{ $recordType->id }}">{{ $recordType->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('recordType'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('recordType') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Room</label>
                    <select class="form-control{{ $errors->has('room') ? ' is-invalid' : '' }}" style="width: 100%;" name="room">
                      <option selected value="0">Choose Room Type</option>
                      @foreach ($rooms as $room)
                        <option {{ $patientRecord->room_id == $room->id ? 'selected' : '' }} value="{{ $room->id }}">{{ $room->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('room'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('room') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Start At</label>
                    <input name="startAt" class="form-control{{ $errors->has('startAt') ? ' is-invalid' : '' }}" value="{{$patientRecord->started_at}}" type="date" placeholder="Enter Start At">
                    @if ($errors->has('startAt'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('startAt') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">End At</label>
                    <input name="endAt" class="form-control{{ $errors->has('endAt') ? ' is-invalid' : '' }}" value="{{$patientRecord->end_at}}" type="date" placeholder="Enter Start At">
                    @if ($errors->has('endAt'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('endAt') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      placeholder="Enter Description here...">{{$patientRecord->description}}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input 
                        name="isReleased" class="form-check-input" 
                        type="checkbox" 
                        {{ $patientRecord->isReleased == 1 ? 'checked' : '' }}>Discharged
                    </label>
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('patientRecords.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection