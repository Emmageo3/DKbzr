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
        <a @if(Session::get('page') == "sections" || Session::get('page') == "categories" || Session::get('page') == "products") style="background-color: #4B49AC !important; color: #fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Catalogue</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-catalogue">
          <ul class="nav flex-column sub-menu" style="background-color: #fff !important;">
            <li class="nav-item">
                <a @if(Session::get('page') == "sections") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/sections') }}">Catégories</a>
            </li>
            <li class="nav-item">
                <a @if(Session::get('page') == "categories") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/categories') }}">Sous-catégories</a></li>
            <li class="nav-item"> <a @if(Session::get('page') == "products") style="background-color: #4B49AC !important; color: #fff !important" @else style="background-color: #fff !important; color: #4B49AC !important"  @endif class="nav-link" href="{{ url('admin/products') }}">Produits</a></li>
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
    </ul>
  </nav>
