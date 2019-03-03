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
            <form method="POST" action="{{ route('outPatients.update', $outPatient) }}">
              @method('PUT')
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
                              <option {{ $outPatient->patient_id == $patient->id ? 'selected' : '' }} value="{{ $patient->id }}">{{ ucfirst($patient->first_name) . ' ' . ucfirst($patient->middle_name) . ' ' . ucfirst($patient->last_name) }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('patientInformation'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('patientInformation') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Weight</label>
                          <input name="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{$outPatient->weight}}" type="text" placeholder="Enter Weight">
                          @if ($errors->has('weight'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('weight') }}</strong>
                              </span>
                          @endif
                        </div>
                          <div class="form-group">
                            <label class="control-label">Height</label>
                            <input name="height" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" value="{{$outPatient->height}}" type="text" placeholder="Enter height">
                            @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Temperature</label>
                            <input name="temperature" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" value="{{$outPatient->temperature}}" type="text" placeholder="Enter temperature">
                            @if ($errors->has('temperature'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('temperature') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Blood Pressure</label>
                            <input name="blood_pressure" class="form-control{{ $errors->has('blood_pressure') ? ' is-invalid' : '' }}" value="{{$outPatient->blood_pressure}}" type="text" placeholder="Enter blood pressure">
                            @if ($errors->has('blood_pressure'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('blood_pressure') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Pulse Rate</label>
                            <input name="pulse_rate" class="form-control{{ $errors->has('pulse_rate') ? ' is-invalid' : '' }}" value="{{$outPatient->pulse_rate}}" type="text" placeholder="Enter pulse rate">
                            @if ($errors->has('pulse_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pulse_rate') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <div class="col-md-6">
                        <legend>Checkup</legend>
                        <div class="form-group">
                          <label class="control-label">Doctor</label>
                          <select class="select2 form-control{{ $errors->has('admitted_checkup_by') ? ' is-invalid' : '' }}" style="width: 100%;" name="admitted_checkup_by">
                            <option selected value="0">Choose Doctor</option>
                            @foreach ($users as $user)
                              @if($user->user_role->role_id === 3)
                                <option {{ $outPatient->admitted_and_check_up_by == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
                              @endif
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
                          <input name="admitted_checkup_date" class="form-control{{ $errors->has('admitted_checkup_date') ? ' is-invalid' : '' }}" value="{{$outPatient->addmitted_and_check_up_date}}" type="date" placeholder="Enter pulse rate">
                          @if ($errors->has('admitted_checkup_date'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('admitted_checkup_date') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Time</label>
                          <input name="admitted_checkup_time" class="form-control{{ $errors->has('admitted_checkup_time') ? ' is-invalid' : '' }}" value="{{$outPatient->addmitted_and_check_up_time}}" type="time" placeholder="Enter pulse rate">
                          @if ($errors->has('admitted_checkup_time'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('admitted_checkup_time') }}</strong>
                              </span>
                          @endif
                        </div>
                        <legend>Initial Diagnoses</legend>
                        <div class="form-group">
                          <label class="control-label">Diagnoses Code</label>
                          <select class="select2 form-control{{ $errors->has('diagnose') ? ' is-invalid' : '' }}" style="width: 100%;" name="diagnose">
                            <option selected value="0">Choose Code</option>
                            @foreach ($diagnoses as $diagnose)
                              <option {{ $patientDiagnose->diagnose_id == $diagnose->id ? 'selected' : '' }} value="{{ $diagnose->id }}">{{ $diagnose->code }}</option>
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
                            placeholder="Enter diagnoses_description here...">{{$patientDiagnose->diagnoses}}</textarea>
                          @if ($errors->has('diagnoses_description'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('diagnoses_description') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Remarks</label>
                          <textarea name="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                            placeholder="Enter remarks here...">{{$patientDiagnose->remarks}}</textarea>
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
                                      <option {{ $outPatient->philhealth_membership_id == $philhealthMembership->id ? 'selected' : '' }} value="{{ $philhealthMembership->id }}">{{$philhealthMembership->code}}</option>
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
                                  <input name="sponsor" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" value="{{$outPatient->sponsor}}" type="text" placeholder="Enter Sponsor">
                                  @if ($errors->has('sponsor'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('sponsor') }}</strong>
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
                                    @if($user->user_role->role_id === 3)
                                      <option {{ $outPatient->attending_physician == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
                                    @endif
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
                                    <option {{ $outPatient->chart_completed_by == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->middle_name) . ' ' . ucfirst($user->last_name) }}</option>
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
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('outPatients.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection