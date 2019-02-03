@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">Billing - 
          {{ ucfirst($patientRecord->patient->first_name) . ' ' . ucfirst($patientRecord->patient->middle_name) . ' ' . ucfirst($patientRecord->patient->last_name) }}
        </div>
        <div class="date">{{\Carbon\Carbon::now()->toFormattedDateString()}}</div>
    </header><!-- /header -->
    <div class="content">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Charges</th>
            <th>Quantity/Days</th>
            <th>Created</th>
            <th>Price</th>
            <th>Description</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $totalBill = 0; ?>
          @foreach ($patientBillings as $patientBilling)
            <?php $totalBill += $patientBilling->total; ?>
            <tr>
                <td>{{ $patientBilling->id }}</td>
                <td>{{ ucfirst($patientBilling->code) }}</td>
                <td>{{ $patientBilling->quantity }}</td>
                <td>{{ $patientBilling->created_at->toFormattedDateString() }}</td>
                <td style="text-align: right">{{ $patientBilling->price }}</td>
                <td>{{ $patientBilling->description }}</td>
                <td style="text-align: right">{{ $patientBilling->total }}</td>
            </tr>
          @endforeach
            <tr>
              <td colspan="7" style="text-align: right; font-weight: 600; font-size: 18px">Total: {{ $totalBill }}</td>  
            </tr>
        </tbody>
      </table>
    </div>
@endsection