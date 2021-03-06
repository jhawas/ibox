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
            <h3 class="tile-title">Patient Billing Form</h3>
            <form method="POST" action="{{ route('patientBillings.store', $patientRecord) }}">
              @csrf
              <div class="tile-body">
                  {{-- <div class="form-group">
                    <label class="control-label">Charges</label>
                    <select class="select2 form-control{{ $errors->has('typeOfCharge') ? ' is-invalid' : '' }}" style="width: 100%;" name="typeOfCharge">
                      <option selected value="0"><--Choose Charges--></option>
                      @foreach ($types as $index => $type)
                        @if ($type->typeOfCharges->count() > 0)
                          <option disabled>{{ strtoupper($type->code) }}</option>
                          @foreach ($type->typeOfCharges as $index2 => $charge)
                            <option {{ old('typeOfCharge') == $charge->id ? 'selected' : '' }} value="{{$charge->id}}">{{ ucfirst($charge->code) }}</option>
                          @endforeach
                        @endif
                      @endforeach
                    </select>
                    @if ($errors->has('typeOfCharge'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('typeOfCharge') }}</strong>
                        </span>
                    @endif
                  </div> --}}
                  <div class="form-group">
                    <label class="control-label">Charge Code</label>
                    <input name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ old('code') }}" type="text" placeholder="Enter code">
                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Price</label>
                    <input name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" type="text" placeholder="Enter price">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Quantity/Day</label>
                    <input name="quantity" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity') }}" type="text" placeholder="Enter quantity">
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('quantity') }}</strong>
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
              </div>
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
                <a class="btn btn-secondary" href="{{ route('patientBillings.index', $patientRecord) }}">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                </a>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection