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
            <intravenous-fluid-component user_id={{Auth::user()->id}} />
            {{-- <div class="controller-wrapper">
              <a href="{{ route('intravenousFluids.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Record ID</th>
                  <th>Patient</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Solution</th>
                  <th>Vol.</th>
                  <th>GTSS</th>
                  <th>Remarks</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($intravenousFluids as $intravenousFluid)
                  <tr>
                      <td>{{ $intravenousFluid->id }}</td>
                      <td>{{ $intravenousFluid->patient_record_id }}</td>
                      <td>{{ ucfirst($intravenousFluid->record->patient->first_name) . ' ' . ucfirst($intravenousFluid->record->patient->middle_name) . ' ' . ucfirst($intravenousFluid->record->patient->last_name) }}</td>
                      <td>{{ $intravenousFluid->date }}</td>
                      <td>{{ $intravenousFluid->time }}</td>
                      <td>{{ $intravenousFluid->kind_of_solution }}</td>
                      <td>{{ $intravenousFluid->vol }}</td>
                      <td>{{ $intravenousFluid->gtss }}</td>
                      <td>{{ $intravenousFluid->remarks }}</td>
                      <td>
                        <a href="{{ route('intravenousFluids.show', $intravenousFluid) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('intravenousFluids.edit', $intravenousFluid) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $intravenousFluid->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.intravenousFluids.destroy')

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