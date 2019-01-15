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
              <a href="{{ route('patientRecords.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Status</th>
                  <th>Room</th>
                  <th>Started At</th>
                  <th>Billing</th>
                  <th>Discharged</th>
                  <th>Action</th>
                </tr>
              </thead>w
              <tbody>
                @foreach ($patientRecords as $patientRecord)
                  <tr>
                      <td>{{ $patientRecord->id }}</td>
                      <td>{{ 
                        ucfirst($patientRecord->user->first_name) . ' ' . 
                        ucfirst($patientRecord->user->middle_name) . ' ' . 
                        ucfirst($patientRecord->user->last_name) }}</td>
                      <td>{{ $patientRecord->recordType->code }}</td>
                      <td>{{ $patientRecord->room->code }}</td>
                      <td>{{ $patientRecord->started_at }}</td>
                      <td>
                        <a href="{{ route('patientBillings.index', $patientRecord) }}">
                          Billing
                        </a>
                      </td>
                      <td>{{ $patientRecord->isReleased ? 'Yes' : 'No' }}</td>
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
            </table>
          </div>
      </div>
    </div>
    </div>
@endsection