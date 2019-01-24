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
              <a href="{{ route('rounds.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Description/Note</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rounds as $round)
                  <tr>
                      <td>{{ $round->id }}</td>
                      <td>{{ 'Record ID:' . $round->records->id . ' ( ' . ucfirst($round->records->user->first_name) . ' ' . ucfirst($round->records->user->middle_name) . ' ' . ucfirst($round->records->user->last_name) . ' )' }}</td>
                      <td>{{ $round->description }}</td>
                      <td>{{ $round->date }}</td>
                      <td>{{ \Carbon\Carbon::parse($round->time)->format('h:i A') }}</td>
                      <td>
                        <a href="{{ route('rounds.show', $round) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('rounds.edit', $round) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $round->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.rounds.destroy')

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