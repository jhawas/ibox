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
            <h3 class="tile-title">Intravenous Fluid Form</h3>
            <form method="POST" action="{{ route('intravenousFluids.update', $intravenousFluid) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Patient Record</label>
                            <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                              <option selected value="0">Choose Patient</option>
                              @foreach ($patientRecords as $patientRecord)
                                <option {{ $intravenousFluid->patient_record_id == $patientRecord->id ? 'selected' : '' }} value="{{ $patientRecord->id }}">
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
                            <input name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{$intravenousFluid->date}}" type="date" placeholder="Enter date">
                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Time</label>
                            <input name="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" value="{{$intravenousFluid->time}}" type="time" placeholder="Enter time">
                            @if ($errors->has('time'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('time') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Bot No.</label>
                            <input name="bot_no" class="form-control{{ $errors->has('bot_no') ? ' is-invalid' : '' }}" value="{{$intravenousFluid->bot_no}}" type="text" placeholder="Enter bot no.">
                            @if ($errors->has('bot_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bot_no') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Kind Of Solution</label>
                            <textarea name="kind_of_solution" class="form-control{{ $errors->has('kind_of_solution') ? ' is-invalid' : '' }}"
                              placeholder="Enter kind of solution here...">{{$intravenousFluid->kind_of_solution}}</textarea>
                            @if ($errors->has('kind_of_solution'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kind_of_solution') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Vol.</label>
                            <input name="vol" class="form-control{{ $errors->has('vol') ? ' is-invalid' : '' }}" value="{{$intravenousFluid->vol}}" type="text" placeholder="Enter vol">
                            @if ($errors->has('vol'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('vol') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">GTSS</label>
                            <input name="gtss" class="form-control{{ $errors->has('gtss') ? ' is-invalid' : '' }}" value="{{$intravenousFluid->gtss}}" type="text" placeholder="Enter gtss">
                            @if ($errors->has('gtss'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gtss') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Remarks</label>
                            <textarea name="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                              placeholder="Enter remarks here...">{{$intravenousFluid->remarks}}</textarea>
                            @if ($errors->has('remarks'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('remarks') }}</strong>
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
                <a class="btn btn-secondary" href="{{ route('intravenousFluids.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection