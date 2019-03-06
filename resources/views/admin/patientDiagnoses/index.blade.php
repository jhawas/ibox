@extends('admin.layouts.app')

@section('content')
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> {{ $page }}</p>
        {{-- <h1><i class="fa fa-dashboard"></i> {{ $page . '-' . ucfirst($patientRecord->patient->first_name) . ' ' . ucfirst($patientRecord->patient->middle_name) . ' ' . ucfirst($patientRecord->patient->last_name) }}</h1>
        <p>{{ $description }}</p> --}}
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">{{ $page }}</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <patient-diagnoses-component user_id={{Auth::user()->id}} />
            {{-- <div class="controller-wrapper">
              <a href="{{ route('patientDiagnoses.create', $patientRecord) }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Diagnoses Code</th>
                  <th>Diagnoses</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($patientDiagnoses as $patientDiagnose)
                  <tr>
                      <td>{{ $patientDiagnose->id }}</td>
                      <td>{{ $patientDiagnose->diagnose ? $patientDiagnose->diagnose->code : null }}</td>
                      <td>{{ $patientDiagnose->diagnoses }}</td>
                      <td>{{ $patientDiagnose->created_at->toFormattedDateString() }}</td>
                      <td>
                        <a href="{{ route('patientDiagnoses.edit', [$patientRecord, $patientDiagnose]) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $patientDiagnose->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.patientDiagnoses.destroy')

                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table> --}}
          </div>
      </div>
    </div>
    </div>
@endsection