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
              <a href="{{ route('outPatients.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Amitted</th>
                  <th>Diagnoses</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($outPatients as $outPatient)
                  <tr>
                      <td>{{ $outPatient->id }}</td>
                      <td>{{ 
                        ucfirst($outPatient->patient->first_name) . ' ' . 
                        ucfirst($outPatient->patient->middle_name) . ' ' . 
                        ucfirst($outPatient->patient->last_name) }}</td>
                      <td>{{ $outPatient->addmitted_and_check_up_date . '/' . $outPatient->addmitted_and_check_up_time }}</td>
                      <td>
                        <a href="{{ route('patientDiagnoses.index', $outPatient) }}">
                          Diagnoses
                        </a>
                      </td>
                      <td>
                        <a href="{{ route('outPatients.show', $outPatient) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('outPatients.edit', $outPatient) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $outPatient->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.outPatients.destroy')

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