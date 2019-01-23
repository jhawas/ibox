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
            <form method="POST" action="{{ route('patientRecords.store') }}">
              @csrf
              <div class="tile-body">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Patient</label>
                          <select class="select2 form-control{{ $errors->has('patientInformation') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientInformation">
                            <option selected value="0">Choose Patient</option>
                            @foreach ($patientInformations as $patientInformation)
                              <option {{ old('patientInformation') == $patientInformation->id ? 'selected' : '' }} value="{{ $patientInformation->id }}">{{ ucfirst($patientInformation->first_name) . ' ' . ucfirst($patientInformation->middle_name) . ' ' . ucfirst($patientInformation->last_name) }}</option>
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
                          <select class="select2 form-control{{ $errors->has('recordType') ? ' is-invalid' : '' }}" style="width: 100%;" name="recordType">
                            <option selected value="0">Choose Record Type</option>
                            @foreach ($recordTypes as $recordType)
                              <option {{ old('recordType') == $recordType->id ? 'selected' : '' }} value="{{ $recordType->id }}">{{ $recordType->code }}</option>
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
                          <select class="select2 form-control{{ $errors->has('room') ? ' is-invalid' : '' }}" style="width: 100%;" name="room">
                            <option selected value="0">Choose Room Type</option>
                            @foreach ($rooms as $room)
                              <option {{ old('room') == $room->id ? 'selected' : '' }} value="{{ $room->id }}">{{ $room->code }} ({{ $room->room_type->code}})</option>
                            @endforeach
                          </select>
                          @if ($errors->has('room'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('room') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Description</label>
                          <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            placeholder="Enter Description here...">
                            {{old('description')}}
                          </textarea>
                          @if ($errors->has('description'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('description') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-12">
                          <h3 class="tile-title">Initial Test</h3>
                          <div class="form-group">
                            <label class="control-label">Weight</label>
                            <input name="weight" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('weight')}}" type="text" placeholder="Enter Weight">
                            @if ($errors->has('weight'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Height</label>
                            <input name="height" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('height')}}" type="text" placeholder="Enter height">
                            @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Temperature</label>
                            <input name="temperature" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('temperature')}}" type="text" placeholder="Enter temperature">
                            @if ($errors->has('temperature'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('temperature') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Blood Pressure</label>
                            <input name="blood_pressure" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('blood_pressure')}}" type="text" placeholder="Enter blood pressure">
                            @if ($errors->has('blood_pressure'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('blood_pressure') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Pulse Rate</label>
                            <input name="pulse_rate" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('pulse_rate')}}" type="text" placeholder="Enter pulse rate">
                            @if ($errors->has('pulse_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pulse_rate') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Diagnoses Code</label>
                            <select class="select2 form-control{{ $errors->has('diagnoses') ? ' is-invalid' : '' }}" style="width: 100%;" name="diagnoses">
                              <option selected value="0"><--Choose Diagnoses--></option>
                              @foreach ($diagnoses as $index => $diagnose)
                                <option {{ old('diagnoses') == $diagnose->id ? 'selected' : '' }} value="{{$diagnose->id}}">{{ ucfirst($diagnose->code) }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('diagnoses'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('diagnoses') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Initial Diagnoses</label>
                            <textarea name="diagnoses_description" class="form-control{{ $errors->has('diagnoses_description') ? ' is-invalid' : '' }}"
                              placeholder="Enter diagnoses_description here...">
                              {{old('diagnoses_description')}}
                            </textarea>
                            @if ($errors->has('diagnoses_description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('diagnoses_description') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input name="isReleased" class="form-check-input" type="checkbox">Discharged
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