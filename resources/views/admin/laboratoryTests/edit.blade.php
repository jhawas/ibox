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
            <h3 class="tile-title">Laboratory Test Form</h3>
            <form method="POST" action="{{ route('laboratoryTests.update', $laboratoryTest) }}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Patient Record</label>
                    <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                      <option selected value="0">Choose Test</option>
                      @foreach ($patientRecords as $patientRecord)
                        <option {{ $laboratoryTest->patient_record_id == $patientRecord->id ? 'selected' : '' }} value="{{ $patientRecord->id }}">
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
                    <label class="control-label">Type Of Laboratory</label>
                    <select class="select2 form-control{{ $errors->has('typeOfTest') ? ' is-invalid' : '' }}" style="width: 100%;" name="typeOfTest">
                      <option selected value="0">Choose Laboratory</option>
                      @foreach ($typeOfTests as $typeOfTest)
                        <option {{ $laboratoryTest->type_of_charge_id == $typeOfTest->id ? 'selected' : '' }} value="{{ $typeOfTest->id }}">{{ $typeOfTest->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('typeOfTest'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('typeOfTest') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      placeholder="Enter Description here...">{{$laboratoryTest->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="image">Laboratory File</label>
                    <input class="form-control-file" id="file" type="file" aria-describedby="fileHelp" name="file" value="{{$laboratoryTest->image}}"><small class="form-text text-muted" id="fileHelp">this field allow user to add laboratory result</small>
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('laboratoryTests.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection