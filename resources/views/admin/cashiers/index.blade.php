@extends('admin.layouts.app')

@section('content')
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> {{ $page . '-' . ucfirst($patientRecord->user->first_name) . ' ' . ucfirst($patientRecord->user->middle_name) . ' ' . ucfirst($patientRecord->user->last_name) }}</h1>
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
          <form method="POST" action="{{ route('cashiers.store', $patientRecord) }}">
              @csrf
            <div class="tile-body">
                <?php $totalBill = 0; ?>
                <div class="form-group">
                  <label class="control-label">Total Bill</label>
                  @foreach($billings as $billings)
                      <?php $totalBill += $billings->total ?>
                  @endforeach
                  <input name="bill" class="form-control{{ $errors->has('bill') ? ' is-invalid' : '' }}" value="{{$totalBill}}" type="number" placeholder="Enter bill">
                  @if ($errors->has('bill'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('bill') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Amount</label>
                  <input name="amount" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{old('amount')}}" type="number" placeholder="Enter amount">
                  @if ($errors->has('amount'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('amount') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
                <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
              </button>
              <a class="btn btn-secondary" href="{{ route('cashiers.selection') }}">
                <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
              </a>
            </div>
          </form>
      </div>
    </div>
    </div>
@endsection