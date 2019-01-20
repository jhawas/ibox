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
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Patient: {{ 'Record ID:' . $prescription->records->id . ' ( ' . ucfirst($prescription->records->user->first_name) . ' ' . ucfirst($prescription->records->user->middle_name) . ' ' . ucfirst($prescription->records->user->last_name) . ' )' }}</li>
                  <li class="list-group-item">Description/Note: {{ $prescription->description }}</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection