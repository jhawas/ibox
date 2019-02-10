@extends('admin.layouts.plain')

@section('content')
    <header id="header" class="header">
        <h2>Gaviola Medical Hospital</h2>
        <div class="title">STATEMENT OF ACCOUNT</div>
        <div class="row patient-details">
            <div class="col-md-6">
                <div class="group">
                  <div class="label">Patient Name:</div>
                  <div class="value">{{ucfirst($patientRecord->patient->first_name) . ' ' . ucfirst($patientRecord->patient->middle_name) . ' ' . ucfirst($patientRecord->patient->last_name)}}</div>
                </div>
                <div class="group">
                  <div class="label">Address:</div>
                  <div class="value">{{$patientRecord->patient->address}}</div>
                </div>
                 <div class="group">
                  <div class="label">Attending Physician:</div>
                  <div class="value">{{ucfirst($patientRecord->physician->first_name) . ' ' . ucfirst($patientRecord->physician->middle_name) . ' ' . ucfirst($patientRecord->physician->last_name)}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group">
                  <div class="label">Date of Adminission/Time:</div>
                  <div class="value">{{ $patientRecord->addmitted_and_check_up_date . '/' . $patientRecord->addmitted_and_check_up_time}}</div>
                </div>
                <div class="group">
                  <div class="label">Date of Discharge/Time:</div>
                  <div class="value">{{ $patientRecord->discharge_date . '/' . $patientRecord->discharge_time}}</div>
                </div>
            </div>
        </div>
    </header><!-- /header -->
    <div class="content main-billing">
      <table class="table">
        <thead>
          <tr>
            <th>Particulars</th>
            <th>Actual Bill</th>
            <th>VAT exempt</th>
            <th>sr. citizen</th>
            <th>PHIC Case Rate</th>
            <th>HMO</th>
            <th>Excess</th>
          </tr>
        </thead>
        <tbody>
          <?php $totalBill = 0; ?>
          @foreach ($typeOfCharges as $typeOfCharge)
              @if($typeOfCharge->billings->count() > 0 || $typeOfCharge->child->count() > 0)
                <tr>
                  <td>{{$typeOfCharge->code}}</td>
                  <td>
                    @if($typeOfCharge->billings->count() > 0)
                      {{ number_format(($typeOfCharge->billings[0]->price * $typeOfCharge->billings[0]->quantity), 2) }}
                    @elseif( $typeOfCharge->child->count() > 0 )
                        <?php $groupTotal = 0; ?>
                        @foreach($typeOfCharge->child as $child)
                             @if($child->billings->count() > 0)
                                <?php $groupTotal += ($child->billings[0]->price * $child->billings[0]->quantity) ?>
                             @endif
                        @endforeach
                        {{number_format($groupTotal, 2)}}
                    @endif
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    @if($typeOfCharge->billings->count() > 0)
                      <?php $totalBill += ($typeOfCharge->billings[0]->price * $typeOfCharge->billings[0]->quantity); ?>
                      {{ ($typeOfCharge->billings[0]->price * $typeOfCharge->billings[0]->quantity) }}
                    @elseif( $typeOfCharge->child->count() > 0 )
                        <?php $groupTotal = 0; ?>
                        @foreach($typeOfCharge->child as $child)
                             @if($child->billings->count() > 0)
                                <?php $groupTotal += ($child->billings[0]->price * $child->billings[0]->quantity) ?>
                             @endif
                        @endforeach
                        <?php $totalBill += $groupTotal; ?>
                        {{number_format($groupTotal, 2)}}
                    @endif
                  </td>
                </tr>
              @endif
          @endforeach
          <tr>
            <td colspan=6>Total Bill</td>
            <td>{{number_format($totalBill, 2)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="content biling-breakdown">
      <div class="lists">
        @foreach ($typeOfCharges as $typeOfCharge)
          @if($typeOfCharge->child->count() > 0)
              <?php $breakdownTotal = 0; ?>
              <div class="list">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>{{ $typeOfCharge->code }}</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $amount = 0; ?>
                      @foreach($typeOfCharge->child as $key => $child)
                         @if($child->billings->count() > 0)
                            <?php 
                              $amount = number_format(($child->billings[0]->price * $child->billings[0]->quantity), 2);
                              $breakdownTotal += ($child->billings[0]->price * $child->billings[0]->quantity);
                            ?>
                            <tr>
                             <td>{{$child->billings[0]->bill}}</td>
                             <td>{{$child->billings[0]->quantity}}</td>
                             <td>{{$child->billings[0]->price}}</td>
                             <td>{{$amount}}</td>
                            </tr>
                         @endif
                      @endforeach
                      <tr>
                        <td colspan="3">Total</td>
                        <td>{{number_format($breakdownTotal, 2)}}</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
          @endif
        @endforeach
      </div>
    </div>
@endsection