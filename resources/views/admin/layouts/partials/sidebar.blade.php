<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
      <p class="app-sidebar__user-designation">{{ Auth::user()->user_role->role->name }}</p>
    </div>
  </div>
  <ul class="app-menu">
    @if (Auth::user()->user_role->role->name == 'admin')
      <li>
        <a class="app-menu__item" href="#">
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
      <a class="app-menu__item" href="#">
        <i class="app-menu__icon fa fa-pie-chart"></i>
        <span class="app-menu__label">Charts</span>
      </a>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-th-list"></i>
          <span class="app-menu__label">Tables</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a class="treeview-item" href="table-basic.html">
            <i class="icon fa fa-circle-o"></i> Basic Tables
          </a>
        </li>
        <li>
          <a class="treeview-item" href="table-data-table.html">
            <i class="icon fa fa-circle-o"></i> Data Tables
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>