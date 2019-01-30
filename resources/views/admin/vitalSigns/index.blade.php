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
              <a href="{{ route('vitalSigns.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Record ID</th>
                  <th>Patient</th>
                  <th>BP</th>
                  <th>T</th>
                  <th>P</th>
                  <th>R</th>
                  <th>Total Intake</th>
                  <th>Total Output</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vitalSigns as $vitalSign)
                  <tr>
                      <td>{{ $vitalSign->id }}</td>
                      <td>{{ $vitalSign->patient_record_id }}</td>
                      <td>{{ ucfirst($vitalSign->record->patient->first_name) . ' ' . ucfirst($vitalSign->record->patient->middle_name) . ' ' . ucfirst($vitalSign->record->patient->last_name) }}</td>
                      <td>{{ $vitalSign->bp }}</td>
                      <td>{{ $vitalSign->t }}</td>
                      <td>{{ $vitalSign->p }}</td>
                      <td>{{ $vitalSign->r }}</td>
                      <td>{{ $vitalSign->total_intake }}</td>
                      <td>{{ $vitalSign->total_output }}</td>
                      <td>{{ $vitalSign->date }}</td>
                      <td>{{ $vitalSign->time }}</td>
                      <td>
                        <a href="{{ route('vitalSigns.show', $vitalSign) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('vitalSigns.edit', $vitalSign) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $vitalSign->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.vitalSigns.destroy')

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