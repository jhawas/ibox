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
                  @foreach ($patientInformations as $patientInformation)
                    <td>{{ $patientInformation->id }}</td>
                    <td>{{ ucfirst($patientInformation->first_name) . ' ' . ucfirst($patientInformation->middle_name) . ' ' . $patientInformation->last_name }}</td>
                    <td>
                        @foreach ($patientInformation->records as $record)
                            @foreach ($record->diagnoses as $diagnose)
                                <div>{{$diagnose->diagnose->code}}</div>
                            @endforeach
                        @endforeach
                    </td>
                  @endforeach
              </tbody>
            </table>
    </div>
@endsection