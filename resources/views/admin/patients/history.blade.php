@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header header-plain">
        <img class="hospital-logo" src="{{asset('img/hospital_logo.png')}}">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">History - 
          {{ ucfirst($patient->first_name) . ' ' . ucfirst($patient->middle_name) . ' ' .  ucfirst($patient->last_name)}}
        </div>
        <div class="date">{{\Carbon\Carbon::now()->toFormattedDateString()}}</div>
    </header><!-- /header -->
    <div class="content">
        <table class="table">
              <thead>
                <tr>
                  <th>Record ID</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Room</th>
                  <th>Diagnoses</th>
                </tr>
              </thead>
              <tbody> 
                  @foreach ($patient->records as $record)
                    <tr>
                      <td>{{ $record->id}}</td>
                      <td>{{ $record->recordType->code}}</td>
                      <td>{{ $record->created_at->toFormattedDateString()}}</td>
                      <td>{{ $record->room->code}}</td>
                      <td>
                        @foreach ($record->diagnoses as $diagnose)
                            <div>{{$diagnose->diagnose ? $diagnose->diagnose->code : null}}</div>
                        @endforeach
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
    </div>
@endsection