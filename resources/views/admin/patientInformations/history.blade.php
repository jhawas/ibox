@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">History - 
          {{ ucfirst($patientInformation->first_name) . ' ' . ucfirst($patientInformation->middle_name) . ' ' .  ucfirst($patientInformation->last_name)}}
        </div>
        <div class="date">January 17, 2019</div>
    </header><!-- /header -->
    <div class="content">
        <table class="table">
              <thead>
                <tr>
                  <th>Record ID</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Room</th>
                  <th>Description</th>
                  <th>Diagnoses</th>
                </tr>
              </thead>
              <tbody> 
                  @foreach ($patientInformation->records as $record)
                    <tr>
                      <td>{{ $record->id}}</td>
                      <td>{{ $record->recordType->code}}</td>
                      <td>{{ $record->created_at}}</td>
                      <td>{{ $record->room->code}}</td>
                      <td>{{ $record->description}}</td>
                      <td>
                        @foreach ($record->diagnoses as $diagnose)
                            <div>{{$diagnose->diagnose->code}}</div>
                        @endforeach
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
    </div>
@endsection