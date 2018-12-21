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
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">User Form</h3>
            <form method="POST" action="{{ route('users.update', $user) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">First Name</label>
                    <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" style="width: 100%;" name="role">
                      <option selected value="0">Choose Role</option>
                      @foreach ($roles as $role)
                        <option {{ old('role') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">First Name</label>
                    <input name="first_name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{ $user->first_name }}" type="text" placeholder="Enter First Name">
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Middle Name</label>
                    <input name="middle_name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{ $user->middle_name }}" type="text" placeholder="Enter Middle Name">
                    @if ($errors->has('middle_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('middle_name') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Last Name</label>
                    <input name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ $user->last_name }}" type="text" placeholder="Enter Last Name">
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}" type="email" placeholder="Enter email address">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Enter Password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Confirm Password</label>
                    <input name="password_confirmation" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Enter Confirm Password">
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Register
                </button>
                <a class="btn btn-secondary" href="#">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection