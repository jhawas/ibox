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
            <record-component user_id={{Auth::user()->id}} />
            {{-- <div class="controller-wrapper">
              <a href="{{ route('patientRecords.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Status</th>
                  <th>Room</th>
                  <th>Bed</th>
                  <th>A & C (Date/Time)</th>
                  <th>Discharge(Date/Time)</th>
                  <th>Disposition</th>
                  <th>Diagnoses</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($patientRecords as $patientRecord)
                  <tr>
                      <td>{{ $patientRecord->id }}</td>
                      <td>{{ 
                        ucfirst($patientRecord->patient->first_name) . ' ' . 
                        ucfirst($patientRecord->patient->middle_name) . ' ' . 
                        ucfirst($patientRecord->patient->last_name) }}</td>
                      <td>{{ $patientRecord->recordType->code }}</td>
                      <td>{{ $patientRecord->room ? $patientRecord->room->code : null }}</td>
                      <td>{{ $patientRecord->bed }}</td>
                      <td>{{ $patientRecord->addmitted_and_check_up_date . '/' . $patientRecord->addmitted_and_check_up_time }}</td>
                      <td>{{ $patientRecord->discharge_date . '/' . $patientRecord->discharge_time }}</td>
                      <td>{{$patientRecord->disposition ? $patientRecord->disposition->code : null}}</td>
                      <td>
                        <a href="{{ route('patientDiagnoses.index', $patientRecord) }}">
                          Diagnoses
                        </a>
                      </td>
                      <td>
                        <a href="{{ route('patientRecords.show', $patientRecord) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('patientRecords.edit', $patientRecord) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $patientRecord->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.patientRecords.destroy')

                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table> --}}
          </div>
      </div>
    </div>
    </div>
@endsection