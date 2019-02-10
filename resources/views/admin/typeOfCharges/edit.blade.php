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
            <h3 class="tile-title">Type Of Charge Form</h3>
            <form method="POST" action="{{ route('typeOfCharges.update', $typeOfCharge) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Name</label>
                    <input name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ $typeOfCharge->code }}" type="text" placeholder="Enter Code">
                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Parent Charge (Optional Field)</label>
                    <select class="select2 form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" style="width: 100%;" name="parent">
                      <option selected value="0">Choose Parent</option>
                      @foreach ($typeOfCharges as $charge)
                        <option {{ $typeOfCharge->parent_id == $charge->id ? 'selected' : '' }} value="{{ $charge->id }}">{{ $charge->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('parent'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('parent') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Price</label>
                    <input name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $typeOfCharge->price }}" type="text" placeholder="Enter Price">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      placeholder="Enter Description here..."
                    >{{$typeOfCharge->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('typeOfCharges.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection