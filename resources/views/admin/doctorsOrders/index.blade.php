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
            <doctors-order-component />
            {{-- <div class="controller-wrapper">
              <a href="{{ route('doctorsOrders.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Record ID</th>
                  <th>Patient</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Progress Note</th>
                  <th>Doctor's Orders</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($doctorsOrders as $doctorsOrder)
                  <tr>
                      <td>{{ $doctorsOrder->id }}</td>
                      <td>{{ $doctorsOrder->patient_record_id }}</td>
                      <td>{{ ucfirst($doctorsOrder->record->patient->first_name) . ' ' . ucfirst($doctorsOrder->record->patient->middle_name) . ' ' . ucfirst($doctorsOrder->record->patient->last_name) }}</td>
                      <td>{{ $doctorsOrder->date }}</td>
                      <td>{{ $doctorsOrder->time }}</td>
                      <td>{{ $doctorsOrder->progress_note }}</td>
                      <td>{{ $doctorsOrder->doctors_orders }}</td>
                      <td>
                        <a href="{{ route('doctorsOrders.show', $doctorsOrder) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('doctorsOrders.edit', $doctorsOrder) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $doctorsOrder->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.doctorsOrders.destroy')

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