<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }}" @if(Session::get('page')=='dashboard') style="background-color: #4B49AC !important; color: #fff !important" @endif>
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      @if(Auth::guard('admin')->user()->type=="vendor")
      <li class="nav-item">
        <a @if(Session::get('page') == "personal" || Session::get('page') == "business" || Session::get('page') == "bank") style="background-color: #4B49AC !important; color: #fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-vendeurs" aria-expanded="false" aria-controls="ui-vendeurs">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Informations</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-vendeurs">
          <ul class="nav flex-column sub-menu" style="background-color: #fff !important;">
            <li class="nav-item">
                <a @if(Session::get('page') == "personal") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Profil</a></li>
            <li class="nav-item">
                <a @if(Session::get('page') == "business") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Boutique</a></li>
            <li class="nav-item">
                <a @if(Session::get('page') == "bank") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/update-vendor-details/bank') }}">Banque</a></li>
          </ul>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a @if(Session::get('page') == "update_admin_password" || Session::get('page') == "update_admin_details") style="background-color: #4B49AC !important; color: #fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Paramètres</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-settings">
          <ul class="nav flex-column sub-menu" style="background-color: #fff !important">
            <li class="nav-item">
                <a @if(Session::get('page') == "update_admin_password") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important" @endif class="nav-link" href="{{ url('admin/update-admin-password') }}">Mot de passe</a>
            </li>
            <li class="nav-item">
                <a @if(Session::get('page') == "update_admin_details") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/update-admin-details') }}">Informations</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a @if(Session::get('page') == "viewadmin" || Session::get('page') == "viewsubadmin" || Session::get('page') == "viewvendor" || Session::get('page') == "viewall") style="background-color: #4B49AC !important; color: #fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-management" aria-expanded="false" aria-controls="ui-management">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-management">
          <ul class="nav flex-column sub-menu" style="background-color: #fff !important;">
            <li class="nav-item">
                <a @if(Session::get('page') == "viewadmin") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/admins/admin') }}">Admins</a>
            </li>
            <li class="nav-item">
                <a @if(Session::get('page') == "viewsubadmin") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/admins/subadmin') }}">Sous-admins</a></li>
            <li class="nav-item"> <a @if(Session::get('page') == "viewvendor") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/admins/vendor') }}">Vendeurs</a></li>
            <li class="nav-item"> <a @if(Session::get('page') == "viewall") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/admins/') }}">Tout</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-clients" aria-expanded="false" aria-controls="ui-clients">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Management clients</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-clients">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users') }}">Clients</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/subscribers') }}">Inscriptions</a></li>
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Form elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="icon-bar-graph menu-icon"></i>
          <span class="menu-title">Charts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-ban menu-icon"></i>
          <span class="menu-title">Error pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>
