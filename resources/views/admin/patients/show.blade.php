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
                <div class="title-container">
                  <h4>Information</h4>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Name: {{ ucfirst($patient->first_name) . ' ' . ucfirst($patient->middle_name) . ' ' . ucfirst($patient->last_name)}}</li>
                  <li class="list-group-item">Birthdate: {{ $patient->birthdate }}</li>
                  <li class="list-group-item">Sex: {{ $patient->sex }}</li>
                  <li class="list-group-item">Religion: {{ $patient->religion }}</li>
                  <li class="list-group-item">Civil Status: {{ $patient->civil_status }}</li>
                  <li class="list-group-item">Address: {{ $patient->address }}</li>
                  <li class="list-group-item">Spouse: {{ $patient->spouse }}</li>
                  <li class="list-group-item">Spouse Address: {{ $patient->spouse_address }}</li>
                  <li class="list-group-item">Mother: {{ $patient->mother }}</li>
                  <li class="list-group-item">Father: {{ $patient->father }}</li>
                  <li class="list-group-item">Emergency Contact: {{ $patient->e_name }}</li>
                  <li class="list-group-item">Emergency Contact Number: {{ $patient->e_contact }}</li>
                  <li class="list-group-item">Emergency Address: {{ $patient->e_address }}</li>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Medical History</h3>
                @foreach ($patient->records as $key => $record)
                  <?php $total = 0 ?>
                  <div class="record-container">
                      <div class="record-id-container">
                          <h5>{{ $record->created_at->toFormattedDateString() }}</h5>
                      </div>
                  </div> 
                  <div class="table-wrapper">
                    <h5>Diagnoses</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Diagnoses Code</th>
                          <th>Diagnoses</th>
                          <th>Remarks</th>
                          <th>Created</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->diagnoses as $diagnose)
                          <tr>
                              <td>{{ $diagnose->diagnose ? $diagnose->diagnose->code : null }}</td>
                              <td>{{ $diagnose->diagnoses }}</td>
                              <td>{{ $diagnose->remarks }}</td>
                              <td>{{ $diagnose->created_at->toFormattedDateString() }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="table-wrapper">
                    <h5>Vital Signs</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>BP</th>
                          <th>T</th>
                          <th>P</th>
                          <th>R</th>
                          <th>Total Intake</th>
                          <th>Total Output</th>
                          <th>Date</th>
                          <th>Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->vitalSigns as $vitalSign)
                          <tr>
                              <td>{{ $vitalSign->id }}</td>
                              <td>{{ $vitalSign->bp }}</td>
                              <td>{{ $vitalSign->t }}</td>
                              <td>{{ $vitalSign->p }}</td>
                              <td>{{ $vitalSign->r }}</td>
                              <td>{{ $vitalSign->total_intake }}</td>
                              <td>{{ $vitalSign->total_output }}</td>
                              <td>{{ $vitalSign->date }}</td>
                              <td>{{ $vitalSign->time }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="table-wrapper">
                    <h5>Laboratory</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Laboratory</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->laboratory as $laboratoryTest)
                          <tr>
                              <td>{{ $laboratoryTest->id }}</td>
                              <td>{{ strtoupper($laboratoryTest->laboratory->code) }}</td>
                              <td>{{ $laboratoryTest->description }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="table-wrapper">
                    <h5>Doctor's Order</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Progress Note</th>
                          <th>Doctor's Orders</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->doctorsOrders as $doctorsOrder)
                          <tr>
                              <td>{{ $doctorsOrder->id }}</td>
                              <td>{{ $doctorsOrder->date }}</td>
                              <td>{{ $doctorsOrder->time }}</td>
                              <td>{{ $doctorsOrder->progress_note }}</td>
                              <td>{{ $doctorsOrder->doctors_orders }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="table-wrapper">
                    <h5>Nurse Note</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Focus</th>
                          <th>Action Response</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->nursesNotes as $nursesNote)
                          <tr>
                              <td>{{ $nursesNote->id }}</td>
                              <td>{{ $nursesNote->date }}</td>
                              <td>{{ $nursesNote->time }}</td>
                              <td>{{ $nursesNote->focus }}</td>
                              <td>{{ $nursesNote->data_action_response }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                @endforeach
            </div>
          </div>
      </div>
    </div>
@endsection