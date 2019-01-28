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
                  <li class="list-group-item">Email: {{ $patient->email }}</li>
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
                          <h5>Record ID: {{ $record->id }}</h5>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Status: {{$record->recordType->code}}</li>
                            <li class="list-group-item">Room: {{$record->room->code}}</li>
                            <li class="list-group-item">Description/Details: {{$record->description}}</li>
                            <li class="list-group-item">Date and Time: {{$record->created_at}}</li>
                          </ul>
                      </div>
                  </div> 
                  <div>
                    <h5>Billing</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Charges</th>
                          <th>Amount</th>
                          <th>Quantity/Days</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->billings as $key2 => $billing)
                         <?php $total += $billing->total ?>
                          <tr>
                            <td>{{ $billing->code }}</td>
                            <td>{{ $billing->price }}</td>
                            <td>{{ $billing->quantity }}</td>
                            <td>{{ $billing->total }}</td>
                          </tr>
                        @endforeach
                        <tr>
                          <td colspan="4">Total: P{{ number_format($total,2) }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div>
                    <h5>Patient Chart</h5>
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
                        @foreach ($record->diagnoses as $diagnose)
                          <tr>
                              <td>{{ $diagnose->diagnose->code }}</td>
                              <td>{{ $diagnose->description }}</td>
                              <td>{{ $diagnose->weight }}</td>
                              <td>{{ $diagnose->height }}</td>
                              <td>{{ $diagnose->temperature }}</td>
                              <td>{{ $diagnose->blood_pressure }}</td>
                              <td>{{ $diagnose->pulse_rate }}</td>
                              <td>{{ $diagnose->created_at->toFormattedDateString() }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div>
                    <h5>Prescriptions</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Description/Note</th>
                          <th>Date</th>
                          <th>Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->prescriptions as $prescription)
                          <tr>
                              <td>{{ $prescription->description }}</td>
                              <td>{{ $prescription->date }}</td>
                              <td>{{ \Carbon\Carbon::parse($prescription->time)->format('h:i A') }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div>
                    <h5>Rounds</h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Description/Note</th>
                          <th>Date</th>
                          <th>Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($record->rounds as $round)
                          <tr>
                              <td>{{ $round->description }}</td>
                              <td>{{ $round->date }}</td>
                              <td>{{ \Carbon\Carbon::parse($round->time)->format('h:i A') }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              @endforeach
            </div>
          </div>
      </div>
    </div>
@endsection