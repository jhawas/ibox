@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">Patient Master List</div>
        <div class="date">January 17, 2019</div>
    </header><!-- /header -->
    <div class="content">
        <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient</th>
                  <th>Diagnoses</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($patients as $patient)
                    <tr>
                      <td>{{ $patient->id }}</td>
                      <td>{{ ucfirst($patient->first_name) . ' ' . ucfirst($patient->middle_name) . ' ' . $patient->last_name }}</td>
                      <td>
                          @foreach ($patient->records as $record)
                              @foreach ($record->diagnoses as $diagnose)
                                  <div>{{$diagnose->diagnose->code}}</div>
                              @endforeach
                          @endforeach
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
    </div>
@endsection