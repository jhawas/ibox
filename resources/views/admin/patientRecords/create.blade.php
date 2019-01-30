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
        <div class="col-md-12">
          <div class="tile">
            <form method="POST" action="{{ route('patientRecords.store') }}">
              @csrf
              <div class="tile-body">
                  <div class="row">
                      <div class="col-md-6">
                        <legend>Standard Information</legend>
                        <div class="form-group">
                          <label class="control-label">Patient</label>
                          <select class="select2 form-control{{ $errors->has('patient') ? ' is-invalid' : '' }}" style="width: 100%;" name="patient">
                            <option selected value="0">Choose Patient</option>
                            @foreach ($patients as $patient)
                              <option {{ old('patient') == $patient->id ? 'selected' : '' }} value="{{ $patient->id }}">{{ ucfirst($patient->first_name) . ' ' . ucfirst($patient->middle_name) . ' ' . ucfirst($patient->last_name) }}</option>
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
                          <select class="select2 form-control{{ $errors->has('typeOfRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="typeOfRecord">
                            <option selected value="0">Choose Record Type</option>
                            @foreach ($typeOfRecords as $typeOfRecord)
                              <option {{ old('typeOfRecord') == $typeOfRecord->id ? 'selected' : '' }} value="{{ $typeOfRecord->id }}">{{ $typeOfRecord->code }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('typeOfRecord'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('typeOfRecord') }}</strong>
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
                          <label class="control-label">Bed</label>
                          <input name="bed" class="form-control{{ $errors->has('bed') ? ' is-invalid' : '' }}" value="{{old('bed')}}" type="text" placeholder="Enter Bed">
                          @if ($errors->has('bed'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('bed') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Weight</label>
                          <input name="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{old('weight')}}" type="text" placeholder="Enter Weight">
                          @if ($errors->has('weight'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('weight') }}</strong>
                              </span>
                          @endif
                        </div>
                          <div class="form-group">
                            <label class="control-label">Height</label>
                            <input name="height" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" value="{{old('height')}}" type="text" placeholder="Enter height">
                            @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Temperature</label>
                            <input name="temperature" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" value="{{old('temperature')}}" type="text" placeholder="Enter temperature">
                            @if ($errors->has('temperature'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('temperature') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Blood Pressure</label>
                            <input name="blood_pressure" class="form-control{{ $errors->has('blood_pressure') ? ' is-invalid' : '' }}" value="{{old('blood_pressure')}}" type="text" placeholder="Enter blood pressure">
                            @if ($errors->has('blood_pressure'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('blood_pressure') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Pulse Rate</label>
                            <input name="pulse_rate" class="form-control{{ $errors->has('pulse_rate') ? ' is-invalid' : '' }}" value="{{old('pulse_rate')}}" type="text" placeholder="Enter pulse rate">
                            @if ($errors->has('pulse_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pulse_rate') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <div class="col-md-6">
                        <legend>Admission/Check Up</legend>
                        <div class="form-group">
                          <label class="control-label">Doctor</label>
                          <select class="select2 form-control{{ $errors->has('admitted_checkup_by') ? ' is-invalid' : '' }}" style="width: 100%;" name="admitted_checkup_by">
                            <option selected value="0">Choose Doctor</option>
                            @foreach ($users as $user)
                              <option {{ old('admitted_checkup_by') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('admitted_checkup_by'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('admitted_checkup_by') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Date</label>
                          <input name="admitted_checkup_date" class="form-control{{ $errors->has('admitted_checkup_date') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" type="date" placeholder="Enter pulse rate">
                          @if ($errors->has('admitted_checkup_date'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('admitted_checkup_date') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Time</label>
                          <input name="admitted_checkup_time" class="form-control{{ $errors->has('admitted_checkup_time') ? ' is-invalid' : '' }}" value="{{old('admitted_checkup_time')}}" type="time" placeholder="Enter pulse rate">
                          @if ($errors->has('admitted_checkup_time'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('admitted_checkup_time') }}</strong>
                              </span>
                          @endif
                        </div>
                        <legend>Discharge</legend>
                        <div class="form-group">
                          <label class="control-label">Doctor</label>
                          <select class="select2 form-control{{ $errors->has('discharge_by') ? ' is-invalid' : '' }}" style="width: 100%;" name="discharge_by">
                            <option selected value="0">Choose Doctor</option>
                            @foreach ($users as $user)
                              <option {{ old('discharge_by') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('discharge_by'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('discharge_by') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Date</label>
                          <input name="discharge_date" class="form-control{{ $errors->has('discharge_date') ? ' is-invalid' : '' }}" value="{{old('discharge_date')}}" type="date" placeholder="Enter pulse rate">
                          @if ($errors->has('discharge_date'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('discharge_date') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Time</label>
                          <input name="discharge_time" class="form-control{{ $errors->has('discharge_time') ? ' is-invalid' : '' }}" value="{{old('discharge_time')}}" type="time" placeholder="Enter pulse rate">
                          @if ($errors->has('discharge_time'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('discharge_time') }}</strong>
                              </span>
                          @endif
                        </div>
                        <legend>Initial Diagnoses</legend>
                        <div class="form-group">
                          <label class="control-label">Diagnoses Code</label>
                          <select class="select2 form-control{{ $errors->has('diagnose') ? ' is-invalid' : '' }}" style="width: 100%;" name="diagnose">
                            <option selected value="0">Choose Code</option>
                            @foreach ($diagnoses as $diagnose)
                              <option {{ old('diagnose') == $diagnose->id ? 'selected' : '' }} value="{{ $diagnose->id }}">{{ $diagnose->code }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('diagnose'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('diagnose') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Diagnoses</label>
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
                        <div class="form-group">
                          <label class="control-label">Remarks</label>
                          <textarea name="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                            placeholder="Enter remarks here...">
                            {{old('remarks')}}
                          </textarea>
                          @if ($errors->has('remarks'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('remarks') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-12">
                        <legend>Additional Information</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Philhealth Membership</label>
                                  <select class="select2 form-control{{ $errors->has('philhealthMembership') ? ' is-invalid' : '' }}" style="width: 100%;" name="philhealthMembership">
                                    <option selected value="0">Choose Membership</option>
                                    @foreach ($philhealthMemberships as $philhealthMembership)
                                      <option {{ old('philhealthMembership') == $philhealthMembership->id ? 'selected' : '' }} value="{{ $philhealthMembership->id }}">{{$philhealthMembership->code}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('philhealthMembership'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('philhealthMembership') }}</strong>
                                      </span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Sponsor</label>
                                  <input name="sponsor" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" value="{{old('sponsor')}}" type="text" placeholder="Enter Sponsor">
                                  @if ($errors->has('sponsor'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('sponsor') }}</strong>
                                      </span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Disposition</label>
                                  <select class="select2 form-control{{ $errors->has('disposition') ? ' is-invalid' : '' }}" style="width: 100%;" name="disposition">
                                    <option selected value="0">Choose Disposition</option>
                                    @foreach ($dispositions as $disposition)
                                      <option {{ old('disposition') == $disposition->id ? 'selected' : '' }} value="{{ $disposition->id }}">{{$disposition->code}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('disposition'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('room') }}</strong>
                                      </span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Results</label>
                                  <select class="select2 form-control{{ $errors->has('result') ? ' is-invalid' : '' }}" style="width: 100%;" name="result">
                                    <option selected value="0">Choose Result</option>
                                    @foreach ($results as $result)
                                      <option {{ old('result') == $result->id ? 'selected' : '' }} value="{{ $result->id }}">{{$result->code}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('result'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('result') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Attending Physician</label>
                                <select class="select2 form-control{{ $errors->has('physician') ? ' is-invalid' : '' }}" style="width: 100%;" name="physician">
                                  <option selected value="0">Choose Doctor</option>
                                  @foreach ($users as $user)
                                    <option {{ old('physician') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('physician'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('physician') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label class="control-label">Chart Completed By</label>
                                <select class="select2 form-control{{ $errors->has('chartCompletedBy') ? ' is-invalid' : '' }}" style="width: 100%;" name="chartCompletedBy">
                                  <option selected value="0">Choose Staff</option>
                                  @foreach ($users as $user)
                                    <option {{ old('chartCompletedBy') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('chartCompletedBy'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('chartCompletedBy') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input name="discharged" class="form-check-input" type="checkbox">Discharged
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