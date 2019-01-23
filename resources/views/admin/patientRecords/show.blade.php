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
            <div class="tile-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Patient: {{ 
                        ucfirst($patientRecord->user->first_name) . ' ' . 
                        ucfirst($patientRecord->user->middle_name) . ' ' . 
                        ucfirst($patientRecord->user->last_name)
                   }}</li>
                  <li class="list-group-item">Status: {{ $patientRecord->recordType->code }}</li>
                  <li class="list-group-item">Room: {{ $patientRecord->room->code }}</li>
                  <li class="list-group-item">Started At: {{ \Carbon\Carbon::parse($patientRecord->created_at)->format('M, d Y')}}</li>
                  <li class="list-group-item">End At: {{ \Carbon\Carbon::parse($patientRecord->updated_at)->format('M, d Y')}}</li>
                  <li class="list-group-item">Description: {{ $patientRecord->description }}</li>
                   <li class="list-group-item">Dicharged: {{ $patientRecord->isReleased ? 'Yes' : 'No' }}</li>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Patient Chart</h3>
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Diagnoses Code</th>
                        <th>Diagnoses</th>
                        <th>Weight</th>
                        <th>Height</th>
                        <th>Temperature</th>
                        <th>Blood Pressure</th>
                        <th>Pulse Rate</th>
                        <th>Created</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($patientRecord->diagnoses as $diagnose)
                        <tr>
                            <td>{{ $diagnose->diagnose->code }}</td>
                            <td>{{ $diagnose->description }}</td>
                            <td>{{ $diagnose->weight }}</td>
                            <td>{{ $diagnose->height }}</td>
                            <td>{{ $diagnose->temperature }}</td>
                            <td>{{ $diagnose->blood_pressure }}</td>
                            <td>{{ $diagnose->pulse_rate }}</td>
                            <td>{{ $diagnose->created_at->toFormattedDateString() }}</td>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
@endsection