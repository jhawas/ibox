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
              <a href="{{ route('typeOfTests.create') }}" class="btn btn-primary">New</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($typeOfTests as $typeOfTest)
                  <tr>
                      <td>{{ $typeOfTest->id }}</td>
                      <td>{{ $typeOfTest->code }}</td>
                      <td>{{ $typeOfTest->description }}</td>
                      <td>{{ $typeOfTest->created_at->toFormattedDateString() }}</td>
                      <td>{{ $typeOfTest->updated_at->toFormattedDateString() }}</td>
                      <td>
                        <a href="{{ route('typeOfTests.show', ['id' => $typeOfTest->id]) }}" class="btn btn-primary">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('typeOfTests.edit', $typeOfTest) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $typeOfTest->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.typeOfTests.destroy')

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