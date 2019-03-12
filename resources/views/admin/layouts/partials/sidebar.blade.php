<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
      <p class="app-sidebar__user-designation">{{ Auth::user()->user_role->role->name }}</p>
    </div>
  </div>
  <ul class="app-menu">
    {{-- supr admin --}}
    @if (Auth::user()->user_role->role->id == 1 || Auth::user()->user_role->role->id == 2)
      <li>
        <a class="app-menu__item" href="{{ route('home') }}">
          <i class="app-menu__icon fa fa-dashboard"></i>
          <span class="app-menu__label">Dashboard</span>
        </a>
      </li>
      <li>
        <a class="app-menu__item" href="{{ route('users.index') }}">
          <i class="app-menu__icon fa fa-pie-chart"></i>
          <span class="app-menu__label">Users</span>
        </a>
      </li>
    @endif
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-th-list"></i>
          <span class="app-menu__label">Manage Patients</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
            <a class="treeview-item" href="{{ route('patients.index') }}">
              <i class="icon fa fa-circle-o"></i> Patient Information
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('patientRecords.index') }}">
              <i class="icon fa fa-circle-o"></i> In & Out Patient
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('outPatients.index') }}">
              <i class="icon fa fa-circle-o"></i> Out Patient
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('inPatients.index') }}">
              <i class="icon fa fa-circle-o"></i> In Patient
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('patientDiagnoses.index') }}">
              <i class="icon fa fa-circle-o"></i> Diagnoses
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('laboratoryTests.index') }}">
              <i class="icon fa fa-circle-o"></i> Laboratory
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('vitalSigns.index') }}">
              <i class="icon fa fa-circle-o"></i> Vital Sign
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('doctorsOrders.index') }}">
              <i class="icon fa fa-circle-o"></i> Doctor's Order
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('nursesNotes.index') }}">
              <i class="icon fa fa-circle-o"></i> Nurse Note
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('intravenousFluids.index') }}">
              <i class="icon fa fa-circle-o"></i> Intravenous Fluids
            </a>
        </li>
        <li>
            <a class="treeview-item" href="{{ route('medicationAndTreatments.index') }}">
              <i class="icon fa fa-circle-o"></i> Medication & Treatment
            </a>
        </li>
      </ul>
    </li>
    @if(
      Auth::user()->user_role->role->id == 1 || 
      Auth::user()->user_role->role->id == 2 ||
      Auth::user()->user_role->role->id == 4
    )
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-th-list"></i>
          <span class="app-menu__label">Manage Rooms</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a class="treeview-item" href="{{ route('rooms.index') }}">
            <i class="icon fa fa-circle-o"></i> Rooms
          </a>
        </li>
        <li>
          <a class="treeview-item" href="{{ route('floors.index') }}">
            <i class="icon fa fa-circle-o"></i> Floors
          </a>
        </li>
        <li>
          <a class="treeview-item" href="{{ route('roomTypes.index') }}">
            <i class="icon fa fa-circle-o"></i> Room Types
          </a>
        </li>
      </ul>
    </li>
    @endif
   {{--  @if(
      Auth::user()->user_role->role->id == 1 || 
      Auth::user()->user_role->role->id == 2 ||
      Auth::user()->user_role->role->id == 5
    )
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-th-list"></i>
          <span class="app-menu__label">Pharmacy</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a class="treeview-item" href="{{ route('medicineStocks.index') }}">
            <i class="icon fa fa-circle-o"></i> Medicines stocks
          </a>
        </li>
        <li>
          <a class="treeview-item" href="{{ route('medicineTypes.index') }}">
            <i class="icon fa fa-circle-o"></i> Medicines Types
          </a>
        </li>
        
      </ul>
    </li>
    @endif --}}
    @if(
      Auth::user()->user_role->role->id == 1 || 
      Auth::user()->user_role->role->id == 2
    )
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-th-list"></i>
          <span class="app-menu__label">Utilities</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a class="treeview-item" href="{{ route('diagnoses.index') }}">
            <i class="icon fa fa-circle-o"></i> Diagnoses
          </a>
        </li>
        {{-- <li>
          <a class="treeview-item" href="{{ route('recordTypes.index') }}">
            <i class="icon fa fa-circle-o"></i> Type of Records
          </a>
        </li> --}}
        <li>
          <a class="treeview-item" href="{{ route('typeOfCharges.index') }}">
            <i class="icon fa fa-circle-o"></i> Type of Charges
          </a>
        </li>
        <li>
          <a class="treeview-item" href="{{ route('typeOfTests.index') }}">
            <i class="icon fa fa-circle-o"></i> Type of Laboratory Test
          </a>
        </li>
      </ul>
    </li>
    @endif
    <li>
      <a class="app-menu__item" href="{{ route('billing.index') }}">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Billing & Payment</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item" href="{{ route('payments.index') }}">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Cashier</span>
      </a>
    </li>
    {{-- <li>
      <a class="app-menu__item" href="{{ route('cashiers.selection') }}">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Cashier</span>
      </a>
    </li> --}}
  </ul>
</aside>