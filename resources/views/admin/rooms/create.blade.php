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
            <h3 class="tile-title">Room Form</h3>
            <form method="POST" action="{{ route('rooms.store') }}">
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Code</label>
                    <input name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{old('code')}}" type="text" placeholder="Enter Code">
                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      placeholder="Enter Description here...">{{old('description')}}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Room Type</label>
                    <select class="select2 form-control{{ $errors->has('roomType') ? ' is-invalid' : '' }}" style="width: 100%;" name="roomType">
                      <option selected value="0">Choose Room Type</option>
                      @foreach ($roomTypes as $roomType)
                        <option {{ old('roomType') == $roomType->id ? 'selected' : '' }} value="{{ $roomType->id }}">{{ $roomType->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('roomType'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('roomType') }}</strong>
                        </span>
                    @endif
                  </div>
                  {{-- <div class="form-group">
                    <label class="control-label">Floors</label>
                    <select class="select2 form-control{{ $errors->has('floor') ? ' is-invalid' : '' }}" style="width: 100%;" name="floor">
                      <option selected value="0">Choose Floor</option>
                      @foreach ($floors as $floor)
                        <option {{ old('floor') == $floor->id ? 'selected' : '' }} value="{{ $floor->id }}">{{ $floor->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('floor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('floor') }}</strong>
                        </span>
                    @endif
                  </div> --}}
                  <div class="form-group">
                    <label class="control-label">Capacity</label>
                    <input name="capacity" class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}" value="{{old('capacity')}}" type="number" placeholder="Enter Capacity">
                    @if ($errors->has('capacity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('capacity') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('rooms.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection