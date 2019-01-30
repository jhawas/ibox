<?php $totalBill = 0; ?>
@extends('admin.layouts.app')

@section('content')
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> {{ $page . '-' . ucfirst($patientRecord->patient->first_name) . ' ' . ucfirst($patientRecord->patient->middle_name) . ' ' . ucfirst($patientRecord->patient->last_name) }}</h1>
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
              <a href="{{ route('patientBillings.create', $patientRecord) }}" class="btn btn-primary">New</a>
              <a href="{{ route('patientBillings.print', $patientRecord) }}" target="_blank" class="btn btn-primary">Print</a>
            </div>
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Charges</th>
                  <th>Quantity/Days</th>
                  <th>Created</th>
                  <th>Price/Rate</th>
                  <th>Description</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- <tr>
                  <td>{{ '' }}</td>
                  <td>{{ ucfirst($patientRecord->recordType->code) }}</td>
                  <td>{{ $patientRecord->created_at->toFormattedDateString() }}</td>
                  <td>{{ 'system generated' }}</td>
                  <td>{{ $patientRecord->room->room_type->price }}</td>
                  <td>{{ 'system generated' }}</td>
                  <td>{{ 'total' }}</td>
                  <td>{{ 'system generated' }}</td>
                </tr> --}}
                @foreach ($patientBillings as $patientBilling)
                  <?php $totalBill += $patientBilling->total; ?>
                  <tr>
                      <td>{{ $patientBilling->id }}</td>
                      <td>{{ ucfirst($patientBilling->code) }}</td>
                      <td>{{ $patientBilling->quantity }}</td>
                      <td>{{ $patientBilling->created_at->toFormattedDateString() }}</td>
                      <td>{{ $patientBilling->price }}</td>
                      <td>{{ $patientBilling->description }}</td>
                      <td>{{ $patientBilling->total }}</td>
                      <td>
                        <a href="{{ route('patientBillings.edit', [$patientRecord, $patientBilling]) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $patientBilling->id }}">
                          <i class="fa fa-eraser"></i>
                        </button>

                         @include('admin.patientBillings.destroy')

                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="total-container" style="padding-top: 20px;">
              <h3>Total Bill: P{{ $totalBill }}</h3>
          </div>
      </div>
    </div>
    </div>
@endsection