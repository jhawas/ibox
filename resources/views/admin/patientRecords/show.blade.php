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
                  <li class="list-group-item">Started At: {{ $patientRecord->started_at->toFormattedDateString() }}</li>
                  <li class="list-group-item">End At: {{ $patientRecord->end_at->toFormattedDateString() }}</li>
                  <li class="list-group-item">Description: {{ $patientRecord->description }}</li>
                   <li class="list-group-item">Dicharged: {{ $patientRecord->isReleased ? 'Yes' : 'No' }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection