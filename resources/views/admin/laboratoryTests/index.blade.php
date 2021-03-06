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
              <a href="{{ route('laboratoryTests.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Record ID</th>
                  <th>Patient</th>
                  <th>Laboratory</th>
                  <th>Description</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($laboratoryTests as $laboratoryTest)
                  <tr>
                      <td>{{ $laboratoryTest->id }}</td>
                      <td>{{ $laboratoryTest->record->id }}</td>
                      <td>{{ ucfirst($laboratoryTest->record->patient->first_name) . ' ' . ucfirst($laboratoryTest->record->patient->middle_name) . ' ' . ucfirst($laboratoryTest->record->patient->last_name) }}</td>
                      <td>{{ strtoupper($laboratoryTest->laboratory->code) }}</td>
                      <td>{{ $laboratoryTest->description }}</td>
                      <td>{{ $laboratoryTest->created_at->toFormattedDateString() }}</td>
                      <td>{{ $laboratoryTest->updated_at->toFormattedDateString() }}</td>
                      <td>
                        <a href="{{ route('laboratoryTests.show', $laboratoryTest) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('laboratoryTests.edit', $laboratoryTest) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $laboratoryTest->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.laboratoryTests.destroy')

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