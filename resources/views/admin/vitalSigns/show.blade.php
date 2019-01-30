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
                  <li class="list-group-item">Record Id: {{ $vitalSign->patient_record_id }}</li>
                  <li class="list-group-item">Patient: {{ ucfirst($vitalSign->record->patient->first_name) . ' ' . ucfirst($vitalSign->record->patient->middle_name) . ' ' . ucfirst($vitalSign->record->patient->last_name) }}</li>
                  <li class="list-group-item">Date: {{ $vitalSign->date }}</li>
                  <li class="list-group-item">Time: {{ $vitalSign->time }}</li>
                  <li class="list-group-item">BP: {{ $vitalSign->bp }}</li>
                  <li class="list-group-item">T: {{ $vitalSign->t }}</li>
                  <li class="list-group-item">P: {{ $vitalSign->p }}</li>
                  <li class="list-group-item">R: {{ $vitalSign->r }}</li>
                  <li class="list-group-item">Intake Oral: {{ $vitalSign->intake_oral }}</li>
                  <li class="list-group-item">Intake I.V.: {{ $vitalSign->intake_iv }}</li>
                  <li class="list-group-item">Intake NG: {{ $vitalSign->intake_ng }}</li>
                  <li class="list-group-item">Total Intake: {{ $vitalSign->total_intake }}</li>
                  <li class="list-group-item">Output Urine: {{ $vitalSign->output_urine }}</li>
                  <li class="list-group-item">Output Stool: {{ $vitalSign->output_stool }}</li>
                  <li class="list-group-item">Output Emesis: {{ $vitalSign->output_emesis }}</li>
                  <li class="list-group-item">Output NG: {{ $vitalSign->output_ng }}</li>
                  <li class="list-group-item">Total Output: {{ $vitalSign->total_output }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection