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
            <b-tabs content-class="mt-3">
              <b-tab title="Results" active>
                  <laboratory-component 
                    user_role={{Auth::user()->user_role->role->id}} 
                    user_id={{Auth::user()->id}} 
                  />
              </b-tab>
              <b-tab title="Request">
                  <laboratory-component 
                    user_role={{Auth::user()->user_role->role->id}} 
                    user_id={{Auth::user()->id}} 
                  />
              </b-tab>
            </b-tabs>
          </div>
      </div>
    </div>
    </div>
@endsection