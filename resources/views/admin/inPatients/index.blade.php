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
            <div class="controller-wrapper">
              <a href="{{ route('inPatients.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Room</th>
                  <th>Bed</th>
                  <th>Amitted</th>
                  <th>Discharge</th>
                  <th>Disposition</th>
                  {{-- <th>Diagnoses</th> --}}
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($inPatients as $inPatient)
                  <tr>
                      <td>{{ $inPatient->id }}</td>
                      <td>{{ 
                        ucfirst($inPatient->patient->first_name) . ' ' . 
                        ucfirst($inPatient->patient->middle_name) . ' ' . 
                        ucfirst($inPatient->patient->last_name) }}</td>
                      <td>{{ $inPatient->room->code }}</td>
                      <td>{{ $inPatient->bed }}</td>
                      <td>{{ $inPatient->addmitted_and_check_up_date . '/' . $inPatient->addmitted_and_check_up_time }}</td>
                      <td>{{ $inPatient->discharge_date . '/' . $inPatient->discharge_time }}</td>
                      <td>{{$inPatient->disposition ? $inPatient->disposition->code : null}}</td>
                      {{-- <td>
                        <a href="{{ route('patientDiagnoses.index', $inPatient) }}">
                          Diagnoses
                        </a>
                      </td> --}}
                      <td>
                        <a href="{{ route('inPatients.show', $inPatient) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('inPatients.edit', $inPatient) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $inPatient->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.inPatients.destroy')

                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    </div>
@endsection