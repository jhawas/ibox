@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">Medicine Inventory</div>
        <div class="date">January 17, 2019</div>
    </header><!-- /header -->
    <div class="content">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Medicine</th>
              <th>Quantity</th>
              <th>Description</th>
              <th>Price</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($medicineStocks as $medicineStock)
              <tr>
                  <td>{{ $medicineStock->id }}</td>
                  <td>{{ $medicineStock->medicine->code }}</td>
                  <td>{{ $medicineStock->quantity }}</td>
                  <td>{{ $medicineStock->description }}</td>
                  <td>{{ $medicineStock->medicine->price }}</td>
                  <td>{{ $medicineStock->created_at->toFormattedDateString() }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection