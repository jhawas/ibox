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
        @if(Auth::user()->user_role->role->id == 1 || Auth::user()->user_role->role->id == 2)
          <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Users</h4>
                <p><b>{{ $users->count() }}</b></p>
              </div>
            </div>
          </div>
        @endif
        <div class="col-md-6 col-lg-3">
          <a href="{{route('records.index')}}">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Patients</h4>
                <p><b>{{ $patients->count() }}</b></p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a href="{{route('records.show', 1)}}">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Out Patients</h4>
                <p><b>{{ $outPatients->count() }}</b></p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a href="{{route('records.show', 2)}}">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>In Patients</h4>
                <p><b>{{ $inPatients->count() }}</b></p>
              </div>
            </div>
          </a>
        </div>
    </div>
@endsection