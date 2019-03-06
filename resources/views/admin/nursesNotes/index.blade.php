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
            <nurses-note-component user_id={{Auth::user()->id}} />
            {{-- <div class="controller-wrapper">
              <a href="{{ route('nursesNotes.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Record ID</th>
                  <th>Patient</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Focus</th>
                  <th>Action Response</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($nursesNotes as $nursesNote)
                  <tr>
                      <td>{{ $nursesNote->id }}</td>
                      <td>{{ $nursesNote->patient_record_id }}</td>
                      <td>{{ ucfirst($nursesNote->record->patient->first_name) . ' ' . ucfirst($nursesNote->record->patient->middle_name) . ' ' . ucfirst($nursesNote->record->patient->last_name) }}</td>
                      <td>{{ $nursesNote->date }}</td>
                      <td>{{ $nursesNote->time }}</td>
                      <td>{{ $nursesNote->focus }}</td>
                      <td>{{ $nursesNote->data_action_response }}</td>
                      <td>
                        <a href="{{ route('nursesNotes.show', $nursesNote) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('nursesNotes.edit', $nursesNote) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $nursesNote->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.nursesNotes.destroy')

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