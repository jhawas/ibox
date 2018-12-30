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
              <a href="{{ route('patientInformations.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($patientInformations as $patientInformation)
                  <tr>
                      <td>{{ $patientInformation->id }}</td>
                      <td>{{ ucfirst($patientInformation->first_name) . ' ' . ucfirst($patientInformation->last_name) }}</td>
                      <td>{{ $patientInformation->email }}</td>
                      <td>{{ $patientInformation->created_at }}</td>
                      <td>{{ $patientInformation->updated_at }}</td>
                      <td>
                        <a href="{{ route('patientInformations.show', $patientInformation) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('patientInformations.edit', $patientInformation) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $patientInformation->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.patientInformations.destroy')

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