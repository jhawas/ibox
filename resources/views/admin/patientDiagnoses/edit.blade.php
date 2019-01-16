@extends('admin.layouts.app')

@section('content')
    <div class="app-title">
      <div>
          <h1><i class="fa fa-dashboard"></i> {{ $page . '-' . ucfirst($patientRecord->user->first_name) . ' ' . ucfirst($patientRecord->user->middle_name) . ' ' . ucfirst($patientRecord->user->last_name)}}</h1>
        <p>{{ $description }}</p>p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">{{ $page }}</a></li>
      </ul>
    </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Patient Diagnoses Form</h3>
            <form method="POST" action="{{ route('patientDiagnoses.update', [$patientRecord, $patientDiagnose]) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Diagnoses</label>
                    <select class="form-control{{ $errors->has('diagnoses') ? ' is-invalid' : '' }}" style="width: 100%;" name="diagnoses">
                      <option selected value="0"><--Choose Diagnoses--></option>
                      @foreach ($diagnoses as $index => $diagnose)
                        <option {{ $patientDiagnose->diagnose_id == $diagnose->id ? 'selected' : '' }} value="{{$diagnose->id}}">{{ ucfirst($diagnose->code) }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('diagnoses'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('diagnoses') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      placeholder="Enter Description here...">{{$patientDiagnose->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('patientDiagnoses.index', $patientRecord) }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection