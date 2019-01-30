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
                  <li class="list-group-item">Record Id: {{ $medicationAndTreatment->patient_record_id }}</li>
                  <li class="list-group-item">Patient: {{ ucfirst($medicationAndTreatment->record->patient->first_name) . ' ' . ucfirst($medicationAndTreatment->record->patient->middle_name) . ' ' . ucfirst($medicationAndTreatment->record->patient->last_name) }}</li>
                  <li class="list-group-item">Date: {{ $medicationAndTreatment->date }}</li>
                  <li class="list-group-item">Time: {{ $medicationAndTreatment->time }}</li>
                  <li class="list-group-item">Medicine: {{ $medicationAndTreatment->medicine }}</li>
                  <li class="list-group-item">Remarks: {{ $medicationAndTreatment->remarks }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection