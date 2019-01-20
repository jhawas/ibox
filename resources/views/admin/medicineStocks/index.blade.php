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
          <div class="tile-body">
            <div class="controller-wrapper">
              <a href="{{ route('medicineStocks.create') }}" class="btn btn-primary">New</a>
               <a href="{{ route('medicineStocks.print') }}" target="_blank" class="btn btn-primary">Print Inventory</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Medicine</th>
                  <th>Quantity</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Created</th>
                  <th>Action</th>
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
                      <td>
                        <a href="{{ route('medicineStocks.show', ['id' => $medicineStock->id]) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('medicineStocks.edit', $medicineStock) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $medicineStock->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.medicineStocks.destroy')

                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    </div>
@endsection