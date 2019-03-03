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
                        ucfirst($inPatient->patient->first_name) . ' ' . 
                        ucfirst($inPatient->patient->middle_name) . ' ' . 
                        ucfirst($inPatient->patient->last_name)
                   }}</li>
                  <li class="list-group-item">Status: {{ $inPatient->recordType->code }}</li>
                  <li class="list-group-item">Room: {{ $inPatient->room->code }}</li>
                  <li class="list-group-item">Started At: {{ \Carbon\Carbon::parse($inPatient->created_at)->format('M, d Y')}}</li>
                  <li class="list-group-item">End At: {{ \Carbon\Carbon::parse($inPatient->updated_at)->format('M, d Y')}}</li>
                  <li class="list-group-item">Description: {{ $inPatient->description }}</li>
                   <li class="list-group-item">Dicharged: {{ $inPatient->isReleased ? 'Yes' : 'No' }}</li>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Diagnoses</h3>
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Diagnoses Name</th>
                        <th>Diagnoses</th>
                        <th>Remarks</th>
                        <th>Created</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($inPatient->diagnoses as $diagnose)
                        <tr>
                            <td>{{ $diagnose->diagnose ? $diagnose->diagnose->code : null}}</td>
                            <td>{{ $diagnose->diagnoses }}</td>
                            <td>{{ $diagnose->remarks }}</td>
                            <td>{{ $diagnose->created_at->toFormattedDateString() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Vital Signs</h3>
                <div>
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
                      @foreach ($inPatient->vitalSigns as $vitalSign)
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
              </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Doctor's Orders</h3>
                <div>
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
                      @foreach ($inPatient->doctorsOrders as $doctorsOrder)
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
              </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Nurses Notes</h3>
                <div>
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
                      @foreach ($inPatient->nursesNotes as $nursesNote)
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
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Intravenous Fluids</h3>
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Solution</th>
                        <th>Vol.</th>
                        <th>GTSS</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($inPatient->intravenousFluids as $intravenousFluid)
                        <tr>
                            <td>{{ $intravenousFluid->id }}</td>
                            <td>{{ $intravenousFluid->date }}</td>
                            <td>{{ $intravenousFluid->time }}</td>
                            <td>{{ $intravenousFluid->kind_of_solution }}</td>
                            <td>{{ $intravenousFluid->vol }}</td>
                            <td>{{ $intravenousFluid->gtss }}</td>
                            <td>{{ $intravenousFluid->remarks }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Medication and Treatment</h3>
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Medicine</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($inPatient->medicationAndTreatments as $medicationAndTreatment)
                        <tr>
                            <td>{{ $medicationAndTreatment->id }}</td>
                            <td>{{ $medicationAndTreatment->medicine }}</td>
                            <td>{{ $medicationAndTreatment->date }}</td>
                            <td>{{ $medicationAndTreatment->time }}</td>
                            <td>{{ $medicationAndTreatment->remarks }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <h3 class="tile-title">Laboratory</h3>
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Record ID</th>
                        <th>Patient</th>
                        <th>Laboratory</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($inPatient->laboratory as $laboratoryTest)
                        <tr>
                            <td>{{ $laboratoryTest->id }}</td>
                            <td>{{ $laboratoryTest->record->id }}</td>
                            <td>{{ ucfirst($laboratoryTest->record->patient->first_name) . ' ' . ucfirst($laboratoryTest->record->patient->middle_name) . ' ' . ucfirst($laboratoryTest->record->patient->last_name) }}</td>
                            <td>{{ strtoupper($laboratoryTest->laboratory->code) }}</td>
                            <td>{{ $laboratoryTest->description }}</td>
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