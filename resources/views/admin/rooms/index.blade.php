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
              <a href="{{ route('rooms.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Floor</th>
                  <th>Room Type</th>
                  <th>capacity</th>
                  <th>Occupied</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rooms as $room)
                  <tr>
                      <td>{{ $room->id }}</td>
                      <td>{{ $room->code }}</td>
                      <td>{{ $room->floor->code }}</td>
                      <td>{{ $room->room_type->code }}</td>
                      <td>{{ $room->capacity }}</td>
                      <td>{{ $room->records->count() }}</td>
                      <td>{{ $room->created_at->toFormattedDateString() }}</td>
                      <td>
                        <a href="{{ route('rooms.show', ['id' => $room->id]) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $room->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.rooms.destroy')

                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
@endsection