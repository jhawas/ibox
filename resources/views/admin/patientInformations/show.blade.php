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
                  <li class="list-group-item">Name: {{ ucfirst($patientInformation->first_name) . ' ' . ucfirst($patientInformation->middle_name) . ' ' . ucfirst($patientInformation->last_name)}}</li>
                  <li class="list-group-item">Email: {{ $patientInformation->email }}</li>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                <div class="title-container">
                  <h4>Medical History</h4>
                </div>
                @foreach ($patientInformation->records as $key => $record)
                    <?php $total = 0 ?>
                    <div class="record-container">
                        <div class="record-id-container">
                            <h5>Record ID: {{ $record->id }}</h5>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">Status: {{$record->recordType->code}}</li>
                              <li class="list-group-item">Room: {{$record->room->code}}</li>
                              <li class="list-group-item">Description/Details: {{$record->description}}</li>
                              <li class="list-group-item">Date and Time: {{$record->created_at}}</li>
                              <li class="list-group-item">
                                Billing Charges:
                                  <ul class="list-group list-group-flush">
                                    @foreach ($record->billings as $key2 => $billing)
                                      <?php $total += $billing->total ?>
                                      <li class="list-group-item">
                                        {{$billing->charge->code}}: P{{$billing->charge->price}}
                                        <br/>
                                        Quantity/Day: {{$billing->quantity}}
                                      </li>
                                    @endforeach
                                      <li class="list-group-item">Total: P{{ $total }}</li>
                                  </ul>
                              </li>
                              <li class="list-group-item">
                                  Diagnoses:
                                  <ul class="list-group list-group-flush">
                                      @foreach ($record->diagnoses as $key2 => $diagnose)
                                          <li class="list-group-item">
                                              {{ $diagnose->diagnose->code }}
                                          </li>
                                      @endforeach
                                  </ul>
                              </li>
                            </ul>
                        </div>
                    </div>  
                @endforeach
            </div>
          </div>
        </div>
      </div>
@endsection