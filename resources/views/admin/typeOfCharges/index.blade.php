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
              <a href="{{ route('typeOfCharges.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>w
              <tbody>
                @foreach ($typeOfCharges as $typeOfCharge)
                  <tr>
                      <td>{{ $typeOfCharge->id }}</td>
                      <td>{{ $typeOfCharge->code }}</td>
                      <td>{{ $typeOfCharge->price }}</td>
                      <td>{{ $typeOfCharge->description }}</td>
                      <td>{{ $typeOfCharge->created_at->toFormattedDateString() }}</td>
                      <td>{{ $typeOfCharge->updated_at->toFormattedDateString() }}</td>
                      <td>
                        <a href="{{ route('typeOfCharges.show', $typeOfCharge) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('typeOfCharges.edit', $typeOfCharge) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $typeOfCharge->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.typeOfCharges.destroy')

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