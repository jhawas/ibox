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
            <h3 class="tile-title">Doctors Order Form</h3>
            <form method="POST" action="{{ route('doctorsOrders.update', $doctorsOrder) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Patient Record</label>
                    <select class="select2 form-control{{ $errors->has('patientRecord') ? ' is-invalid' : '' }}" style="width: 100%;" name="patientRecord">
                      <option selected value="0">Choose Test</option>
                      @foreach ($patientRecords as $patientRecord)
                        <option {{ $doctorsOrder->patient_record_id == $patientRecord->id ? 'selected' : '' }} value="{{ $patientRecord->id }}">
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
                    <input name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{$doctorsOrder->date}}" type="date" placeholder="Enter date">
                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Time</label>
                    <input name="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" value="{{$doctorsOrder->time}}" type="time" placeholder="Enter time">
                    @if ($errors->has('time'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('time') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Progress Note</label>
                    <textarea name="progress_note" class="form-control{{ $errors->has('progress_note') ? ' is-invalid' : '' }}"
                      placeholder="Enter progress_note here...">{{$doctorsOrder->progress_note}}</textarea>
                    @if ($errors->has('progress_note'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('progress_note') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Doctor's Order</label>
                    <textarea name="doctors_orders" class="form-control{{ $errors->has('doctors_orders') ? ' is-invalid' : '' }}"
                      placeholder="Enter doctors_orders here...">{{$doctorsOrder->doctors_orders}}</textarea>
                    @if ($errors->has('doctors_orders'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('doctors_orders') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('doctorsOrders.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection