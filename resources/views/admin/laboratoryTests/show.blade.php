<?php use App\Services\FilePathService; ?>
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
                  <li class="list-group-item">Record ID: 
                    {{ $laboratoryTest->record->id }}
                  </li>
                  <li class="list-group-item">Patient: 
                    {{ ucfirst($laboratoryTest->record->user->first_name) . ' ' . ucfirst($laboratoryTest->record->user->middle_name) . ' ' . ucfirst($laboratoryTest->record->user->last_name) }}
                  </li>
                  <li class="list-group-item">Create At: 
                    {{ $laboratoryTest->created_at }}
                  </li>
                  <li class="list-group-item">Description: 
                    {{ $laboratoryTest->description }}
                  </li>
                  <li class="list-group-item">Test: 
                    {{ $laboratoryTest->charge->code }}
                  </li>
                  <li class="list-group-item"> 
                    <img class="image" src="{{asset('storage/'. FilePathService::setPath($laboratoryTest->image))}}" />
                  </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
@endsection