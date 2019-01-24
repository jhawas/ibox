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
            <h3 class="tile-title">Room Type Form</h3>
            <form method="POST" action="{{ route('roomTypes.store') }}">
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
                      placeholder="Enter Description here...">
                      {{old('description')}}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Floor</label>
                    <input name="floor" class="form-control{{ $errors->has('floor') ? ' is-invalid' : '' }}" value="{{old('floor')}}" type="text" placeholder="Enter Floor">
                    @if ($errors->has('floor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('floor') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Price</label>
                    <input name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{old('price')}}" type="number" placeholder="Enter Price">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('roomTypes.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection