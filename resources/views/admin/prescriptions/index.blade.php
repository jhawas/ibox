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
              <a href="{{ route('prescriptions.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Description/Note</th>
                  <td>Approved</td>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($prescriptions as $prescription)
                  <tr>
                      <td>{{ $prescription->id }}</td>
                      <td>{{ 'Record ID:' . $prescription->records->id . ' ( ' . ucfirst($prescription->records->user->first_name) . ' ' . ucfirst($prescription->records->user->middle_name) . ' ' . ucfirst($prescription->records->user->last_name) . ' )' }}</td>
                      <td>{{ $prescription->description }}</td>
                      <td>{{ $prescription->is_approved ? 'Yes' : 'No' }}</td>
                      <td>{{ $prescription->created_at->toFormattedDateString() }}</td>
                      <td>{{ $prescription->updated_at->toFormattedDateString() }}</td>
                      <td>
                        <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $prescription->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.prescriptions.destroy')

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