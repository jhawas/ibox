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
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Record Id: {{ $nursesNote->patient_record_id }}</li>
                  <li class="list-group-item">Patient: {{ ucfirst($nursesNote->record->patient->first_name) . ' ' . ucfirst($nursesNote->record->patient->middle_name) . ' ' . ucfirst($nursesNote->record->patient->last_name) }}</li>
                  <li class="list-group-item">Date: {{ $nursesNote->date }}</li>
                  <li class="list-group-item">Time: {{ $nursesNote->time }}</li>
                  <li class="list-group-item">Focus: {{ $nursesNote->focus }}</li>
                  <li class="list-group-item">Action Response: {{ $nursesNote->data_action_response }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection