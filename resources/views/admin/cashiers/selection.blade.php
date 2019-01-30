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
          <form method="POST" action="{{ route('cashiers.storeSelection') }}">
            @csrf
            <div class="tile-body">
                <div class="form-group">
                  <label class="control-label">Patient Record</label>
                  <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                    <option selected value="0">Choose Patient</option>
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
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Next
                </button>
                <a class="btn btn-secondary" href="{{ route('cashiers.selection') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
          </form>
      </div>
    </div>
    </div>
@endsection