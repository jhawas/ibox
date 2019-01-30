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
                  <li class="list-group-item">Record Id: {{ $doctorsOrder->patient_record_id }}</li>
                  <li class="list-group-item">Patient: {{ ucfirst($doctorsOrder->record->patient->first_name) . ' ' . ucfirst($doctorsOrder->record->patient->middle_name) . ' ' . ucfirst($doctorsOrder->record->patient->last_name) }}</li>
                  <li class="list-group-item">Date: {{ $doctorsOrder->date }}</li>
                  <li class="list-group-item">Time: {{ $doctorsOrder->time }}</li>
                  <li class="list-group-item">Progress Note: {{ $doctorsOrder->progress_note }}</li>
                  <li class="list-group-item">Doctors Orders: {{ $doctorsOrder->doctors_orders }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection