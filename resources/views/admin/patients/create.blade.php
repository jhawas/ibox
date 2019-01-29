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
            <h3 class="tile-title">Patient Form</h3>
            <form method="POST" action="{{ route('patients.store') }}">
              @csrf
              <div class="tile-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{old('first_name')}}" type="text" placeholder="Enter First Name">
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
                            <label class="control-label">Suffix</label>
                            <input name="suffix" class="form-control{{ $errors->has('suffix') ? ' is-invalid' : '' }}" value="{{old('suffix')}}" type="text" placeholder="Enter Suffix">
                            @if ($errors->has('suffix'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('suffix') }}</strong>
                                </span>
                            @endif
                          </div>
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
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                            @if ($errors->has('sex'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sex') }}</strong>
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
                          <fieldset class="form-group">
                            <legend>Civil Status</legend>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" id="csSingle" type="radio" name="civil_status[]" value="single" checked="">Single
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" id="csMarried" type="radio" name="civil_status[]" value="married">Married
                              </label>
                            </div>
                            <div class="form-check disabled">
                              <label class="form-check-label">
                                <input class="form-check-input" id="csWidowed" type="radio" name="civil_status[]" value="widowed">Widowed
                              </label>
                            </div>
                          </fieldset>
                          <div class="form-group">
                            <label class="control-label">Address</label>
                            <textarea name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                              placeholder="Enter address here...">{{old('address')}}</textarea>                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Spouse</label>
                            <input name="spouse" class="form-control{{ $errors->has('spouse') ? ' is-invalid' : '' }}" value="{{old('spouse')}}" type="text" placeholder="Enter spouse">
                            @if ($errors->has('spouse'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('spouse') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Spouse Address</label>
                            <textarea name="spouse_address" class="form-control{{ $errors->has('spouse_address') ? ' is-invalid' : '' }}"
                              placeholder="Enter address here...">{{old('spouse_address')}}</textarea>                            @if ($errors->has('spouse_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('spouse_address') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Mother</label>
                            <input name="mother" class="form-control{{ $errors->has('mother') ? ' is-invalid' : '' }}" value="{{old('mother')}}" type="text" placeholder="Enter mother">
                            @if ($errors->has('mother'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mother') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Father</label>
                            <input name="father" class="form-control{{ $errors->has('father') ? ' is-invalid' : '' }}" value="{{old('father')}}" type="text" placeholder="Enter father">
                            @if ($errors->has('father'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('father') }}</strong>
                                </span>
                            @endif
                          </div>
                          <legend>Emergency Contact</legend>
                          <div class="form-group">
                            <label class="control-label">Name</label>
                            <input name="e_name" class="form-control{{ $errors->has('e_name') ? ' is-invalid' : '' }}" value="{{old('e_name')}}" type="text" placeholder="Enter e_name">
                            @if ($errors->has('e_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('e_name') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input name="e_contact" class="form-control{{ $errors->has('e_contact') ? ' is-invalid' : '' }}" value="{{old('e_contact')}}" type="text" placeholder="Enter e_contact">
                            @if ($errors->has('e_contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('e_contact') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label class="control-label">Address</label>
                            <textarea name="e_address" class="form-control{{ $errors->has('e_address') ? ' is-invalid' : '' }}"
                              placeholder="Enter address here...">{{old('e_address')}}</textarea>                            @if ($errors->has('e_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('e_address') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('patients.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection