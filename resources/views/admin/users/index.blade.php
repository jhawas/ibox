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
              <a href="{{ route('users.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>specialty</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ ucfirst($user->first_name) . ' ' . ucfirst($user->last_name) }}</td>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->user_role->role->name }}</td>
                      <td>{{ $user->specialty }}</td>
                      <td>
                        <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a 
                          href="{{ Auth::user()->user_role->role->id == 1 ? route('users.edit', $user) : '#' }}" 
                          class="btn btn-primary"
                        >
                          <i class="fa fa-edit"></i>
                        </a>
                        <button 
                          type="button" 
                          class="btn btn-danger" 
                          data-toggle="modal" 
                          data-target="#myModal-{{ $user->id }}"
                          {{ Auth::user()->user_role->role->id == 1 ? '' : 'disabled'}} 
                        >
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.users.destroy')

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