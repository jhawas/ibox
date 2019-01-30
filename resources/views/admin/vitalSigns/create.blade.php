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
            <h3 class="tile-title">Vital Signs Form</h3>
            <form method="POST" action="{{ route('vitalSigns.store') }}">
              @csrf
              <div class="tile-body">
                  <div class="row">
                      <div class="col-md-6">
                        <legend>Standard Information</legend>
                        <div class="form-group">
                          <label class="control-label">Patient Record</label>
                          <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                            <option selected value="0">Choose Test</option>
                            @foreach ($patientRecords as $patientRecord)
                              <option {{ old('patientRecord') == $patientRecord->id ? 'selected' : '' }} value="{{ $patientRecord->id }}">
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
                          <input name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{old('date')}}" type="date" placeholder="Enter date">
                          @if ($errors->has('date'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('date') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Time</label>
                          <input name="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" value="{{old('time')}}" type="time" placeholder="Enter time">
                          @if ($errors->has('time'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('time') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">BP</label>
                          <input name="bp" class="form-control{{ $errors->has('bp') ? ' is-invalid' : '' }}" value="{{old('bp')}}" type="text" placeholder="Enter bp">
                          @if ($errors->has('bp'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('bp') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">T</label>
                          <input name="t" class="form-control{{ $errors->has('t') ? ' is-invalid' : '' }}" value="{{old('t')}}" type="text" placeholder="Enter t">
                          @if ($errors->has('t'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('t') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">P</label>
                          <input name="p" class="form-control{{ $errors->has('p') ? ' is-invalid' : '' }}" value="{{old('p')}}" type="text" placeholder="Enter p">
                          @if ($errors->has('p'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('p') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">R</label>
                          <input name="r" class="form-control{{ $errors->has('r') ? ' is-invalid' : '' }}" value="{{old('r')}}" type="text" placeholder="Enter r">
                          @if ($errors->has('r'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('r') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <legend>Intake</legend>
                        <div class="form-group">
                          <label class="control-label">Oral</label>
                          <input name="intake_oral" class="form-control{{ $errors->has('intake_oral') ? ' is-invalid' : '' }}" value="{{old('intake_oral')}}" type="text" placeholder="Enter Oral">
                          @if ($errors->has('intake_oral'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('intake_oral') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">I.V.</label>
                          <input name="intake_iv" class="form-control{{ $errors->has('intake_iv') ? ' is-invalid' : '' }}" value="{{old('intake_iv')}}" type="text" placeholder="Enter IV">
                          @if ($errors->has('intake_iv'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('intake_iv') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">NG</label>
                          <input name="intake_ng" class="form-control{{ $errors->has('intake_ng') ? ' is-invalid' : '' }}" value="{{old('intake_ng')}}" type="text" placeholder="Enter NG">
                          @if ($errors->has('intake_ng'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('intake_ng') }}</strong>
                              </span>
                          @endif
                        </div>
                        <legend>Output</legend>
                        <div class="form-group">
                          <label class="control-label">Urine</label>
                          <input name="output_urine" class="form-control{{ $errors->has('output_urine') ? ' is-invalid' : '' }}" value="{{old('output_urine')}}" type="text" placeholder="Enter Urine">
                          @if ($errors->has('output_urine'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('output_urine') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Stool</label>
                          <input name="output_stool" class="form-control{{ $errors->has('output_stool') ? ' is-invalid' : '' }}" value="{{old('output_stool')}}" type="text" placeholder="Enter Stool">
                          @if ($errors->has('output_stool'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('output_stool') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">Emesis</label>
                          <input name="output_emesis" class="form-control{{ $errors->has('output_emesis') ? ' is-invalid' : '' }}" value="{{old('output_emesis')}}" type="text" placeholder="Enter Emesis">
                          @if ($errors->has('output_emesis'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('output_emesis') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="control-label">NG</label>
                          <input name="output_ng" class="form-control{{ $errors->has('output_ng') ? ' is-invalid' : '' }}" value="{{old('output_ng')}}" type="text" placeholder="Enter NG">
                          @if ($errors->has('output_ng'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('output_ng') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('vitalSigns.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection