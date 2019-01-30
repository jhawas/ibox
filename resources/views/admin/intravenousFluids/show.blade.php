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
                  <li class="list-group-item">Record Id: {{ $intravenousFluid->patient_record_id }}</li>
                  <li class="list-group-item">Patient: {{ ucfirst($intravenousFluid->record->patient->first_name) . ' ' . ucfirst($intravenousFluid->record->patient->middle_name) . ' ' . ucfirst($intravenousFluid->record->patient->last_name) }}</li>
                  <li class="list-group-item">Date: {{ $intravenousFluid->date }}</li>
                  <li class="list-group-item">Time: {{ $intravenousFluid->time }}</li>
                  <li class="list-group-item">Kind of Solution: {{ $intravenousFluid->kind_of_solution }}</li>
                  <li class="list-group-item">Vol.: {{ $intravenousFluid->vol }}</li>
                  <li class="list-group-item">GTSS: {{ $intravenousFluid->gtss }}</li>
                  <li class="list-group-item">Remarks: {{ $intravenousFluid->remarks }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection