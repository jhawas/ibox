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
              <?php 
                  $doctor = Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name;
              ?>
              <record-component 
                record_type={{$type_of_patient}} 
                user_id={{Auth::user()->id}}
                user_role={{Auth::user()->user_role->role->id}}
                doctor="{{$doctor}}"
              />
          </div>
      </div>
    </div>
    </div>
@endsection