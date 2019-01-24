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
            <h3 class="tile-title">User Form</h3>
            <form method="POST" action="{{ route('users.store') }}">
              @csrf
              <div class="tile-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Role</label>
                            <select class="select2 form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" style="width: 100%;" name="role">
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
                            <input name="first_name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('first_name')}}" type="text" placeholder="Enter First Name">
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Middle Name</label>
                            <input name="middle_name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{old('middle_name')}}" type="text" placeholder="Enter Middle Name">
                            @if ($errors->has('middle_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('middle_name') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{old('last_name')}}" type="text" placeholder="Enter Last Name">
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Email</label>
                            <input name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" type="email" placeholder="Enter email address">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Username</label>
                            <input name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{old('username')}}" type="text" placeholder="Enter Username">
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
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
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Birthdate</label>
                            <input name="birthdate" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" value="{{old('birthdate')}}" type="date" placeholder="Enter Birthdate">
                            @if ($errors->has('birthdate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('birthdate') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Sex</label>
                            <select class="select2 form-control{{ $errors->has('sex') ? ' is-invalid' : '' }}" style="width: 100%;" name="sex">
                              <option selected value="0">Choose Sex</option>
                              <option selected value="male">Male</option>
                              <option selected value="female">Female</option>
                            </select>
                            @if ($errors->has('sex'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sex') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Weight</label>
                            <input name="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{old('weight')}}" type="text" placeholder="Enter weight">
                            @if ($errors->has('weight'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Height</label>
                            <input name="height" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" value="{{old('height')}}" type="text" placeholder="Enter height">
                            @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Religion</label>
                            <input name="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" value="{{old('religion')}}" type="text" placeholder="Enter religion">
                            @if ($errors->has('religion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('religion') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Occupation</label>
                            <input name="occupation" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" value="{{old('occupation')}}" type="text" placeholder="Enter occupation">
                            @if ($errors->has('occupation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('occupation') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Specialty</label>
                            <input name="specialty" class="form-control{{ $errors->has('specialty') ? ' is-invalid' : '' }}" value="{{old('specialty')}}" type="text" placeholder="Enter specialty">
                            @if ($errors->has('specialty'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('specialty') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Degree</label>
                            <input name="degree" class="form-control{{ $errors->has('degree') ? ' is-invalid' : '' }}" value="{{old('degree')}}" type="text" placeholder="Enter degree">
                            @if ($errors->has('degree'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('degree') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Register
                </button>
                <a class="btn btn-secondary" href="{{ route('users.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection