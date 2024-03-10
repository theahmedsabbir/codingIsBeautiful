
    <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- br-header-left -->
      <div class="br-header-right">
        <nav class="nav">
          @php
            // $admin = App\Models\User::find(Session::get('admin_id'));


          @endphp
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down" style="text-transform: capitalize;">{{ Session::get('admin_role') }}</span>
              <img src="{{ url('backend/images/admin_100.png') }}" class="wd-32 rounded-circle" alt="">
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-250">
              <div class="tx-center">
                <a href=""><img src="{{ url('backend/images/admin.png') }}" class="wd-80 rounded-circle" alt=""></a>
                <h6 class="logged-fullname">Admin</h6>
                <p>Admin</p>
              </div>
              <hr>
              <hr>
              <ul class="list-unstyled user-profile-nav">
                <li><a href="{{ url('/') }}"><i class="icon ion-ios-folder"></i> Go to Website</a></li>
                <li><a href="#logout" onclick="event.preventDefault();document.getElementById('logout').submit()"><i class="icon ion-power"></i> Sign Out</a></li>

                <form id="logout" action="{{ url('admin/logout') }}" method="post">
                  @csrf


                </form>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
      </div><!-- br-header-right -->
    </div><!-- br-header -->
