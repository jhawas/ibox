@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">Receipt - {{ ucfirst($cashier->records->patient->first_name) . ' ' . ucfirst($cashier->records->patient->middle_name) . ' ' . ucfirst($cashier->records->patient->last_name) }}</div>
        <div class="date">January 25, 2019</div>
    </header><!-- /header -->
    <div class="content">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Patient</th>
              <th>Total Bill</th>
              <th>Amount</th>
              <th>Changed</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                  <td>{{ $cashier->id }}</td>
                  <td>{{ ucfirst($cashier->records->patient->first_name) . ' ' . ucfirst($cashier->records->patient->middle_name) . ' ' . ucfirst($cashier->records->patient->last_name) }}</td>
                  <td>{{ $cashier->total }}</td>
                  <td>{{ $cashier->amount }}</td>
                  <td>{{ $cashier->change }}</td>
              </tr>
          </tbody>
        </table>
    </div>
@endsection