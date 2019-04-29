@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header header-plain">
        <img class="hospital-logo" src="{{asset('img/hospital_logo.png')}}">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">Patient Master List</div>
        <div class="date">{{\Carbon\Carbon::now()->toFormattedDateString()}}</div>
    </header><!-- /header -->
    <div class="content">
        <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Sex</th>
                  <th>Birthdate</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($patients as $patient)
                    <tr>
                      <td>{{ $patient->id }}</td>
                      <td>{{ ucfirst($patient->first_name) . ' ' . ucfirst($patient->middle_name) . ' ' . $patient->last_name }}</td>
                      <td>{{ $patient->sex}}</td>
                      <td>{{ $patient->birthdate}}</td>
                      {{-- <td>
                          @foreach ($patient->records as $record)
                              @foreach ($record->diagnoses as $diagnose)
                                  <div>{{$diagnose->diagnose ? $diagnose->diagnose->code : null}}</div>
                              @endforeach
                          @endforeach
                      </td> --}}
                    </tr>
                  @endforeach
              </tbody>
            </table>
    </div>
@endsection