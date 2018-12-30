<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
      <p class="app-sidebar__user-designation">{{ Auth::user()->user_role->role->name }}</p>
    </div>
  </div>
  <ul class="app-menu">
    @if (Auth::user()->user_role->role->name == 'super admin')
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
    <li>
        <a class="app-menu__item" href="{{ route('patientInformations.index') }}">
          <i class="app-menu__icon fa fa-pie-chart"></i>
          <span class="app-menu__label">Patient Information</span>
        </a>
    </li>
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
        <li>
          <a class="treeview-item" href="{{ route('massVolumeTypes.index') }}">
            <i class="icon fa fa-circle-o"></i> Mass and Volume Types
          </a>
        </li>
      </ul>
    </li>
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
  </ul>
</aside>