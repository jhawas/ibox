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
            <form method="POST" action="{{ route('medicineStocks.update', $medicineStock) }}">
              @method('PUT')
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                    <label class="control-label">Code</label>
                    <input name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{$medicineStock->code}}" type="text" placeholder="Enter Code">
                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <input name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{$medicineStock->description}}" type="text" placeholder="Enter Description Name">
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Mass and Volume Type</label>
                    <select class="form-control{{ $errors->has('massVolumeType') ? ' is-invalid' : '' }}" style="width: 100%;" name="massVolumeType">
                      <option selected value="0">Choose Mass and Volume</option>
                      @foreach ($massVolumeTypes as $massVolumeType)
                        <option {{ $medicineStock->mass_volume_type_id == $massVolumeType->id ? 'selected' : '' }} value="{{ $massVolumeType->id }}">{{ $massVolumeType->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('massVolumeType'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('massVolumeType') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Medicine Type</label>
                    <select class="form-control{{ $errors->has('medicineType') ? ' is-invalid' : '' }}" style="width: 100%;" name="medicineType">
                      <option selected value="0">Choose Medicine</option>
                      @foreach ($medicineTypes as $medicineType)
                        <option {{ $medicineStock->medicine_type_id == $medicineType->id ? 'selected' : '' }} value="{{ $medicineType->id }}">{{ $medicineType->code }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('medicineType'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('medicineType') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Quantity</label>
                    <input name="quantity" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ $medicineStock->quantity }}" type="number" placeholder="Enter Quantity Name">
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Price</label>
                    <input name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $medicineStock->price }}" type="text" placeholder="Enter Middle Name">
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
                <a class="btn btn-secondary" href="{{ route('medicineStocks.index') }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection