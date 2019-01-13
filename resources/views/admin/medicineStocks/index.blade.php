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
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>quantity</th>
                  <th>price</th>
                  <th>medicine type</th>
                  <th>user</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($medicineStocks as $medicineStock)
                  <tr>
                      <td>{{ $medicineStock->id }}</td>
                      <td>{{ $medicineStock->code }}</td>
                      <td>{{ $medicineStock->description }}</td>
                      <td>{{ $medicineStock->quantity }}</td>
                      <td>{{ $medicineStock->price }}</td>
                      <td>{{ $medicineStock->medicineType->code }}</td>
                      <td>{{ $medicineStock->user_id }}</td>
                      <td>{{ $medicineStock->created_at }}</td>
                      <td>{{ $medicineStock->updated_at }}</td>
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