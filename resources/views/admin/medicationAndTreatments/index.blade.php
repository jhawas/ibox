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
            <medication-and-treatment-component>
            {{-- <div class="controller-wrapper">
              <a href="{{ route('medicationAndTreatments.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Record ID</th>
                  <th>Patient</th>
                  <th>Medicine</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Remarks</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($medicationAndTreatments as $medicationAndTreatment)
                  <tr>
                      <td>{{ $medicationAndTreatment->id }}</td>
                      <td>{{ $medicationAndTreatment->patient_record_id }}</td>
                      <td>{{ ucfirst($medicationAndTreatment->record->patient->first_name) . ' ' . ucfirst($medicationAndTreatment->record->patient->middle_name) . ' ' . ucfirst($medicationAndTreatment->record->patient->last_name) }}</td>
                      <td>{{ $medicationAndTreatment->medicine }}</td>
                      <td>{{ $medicationAndTreatment->date }}</td>
                      <td>{{ $medicationAndTreatment->time }}</td>
                      <td>{{ $medicationAndTreatment->remarks }}</td>
                      <td>
                        <a href="{{ route('medicationAndTreatments.show', $medicationAndTreatment) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('medicationAndTreatments.edit', $medicationAndTreatment) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $medicationAndTreatment->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.medicationAndTreatments.destroy')

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