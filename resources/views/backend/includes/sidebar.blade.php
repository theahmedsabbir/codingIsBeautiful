<div class="br-logo"><a href="{{ url('admin/dashboard') }}"><span>[</span>Coding Is <i> Beautiful</i><span>]</span></a>
</div>
<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{ url('admin/dashboard') }}"
                class="br-menu-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Dashboard</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Manage</label>


        {{-- @dd(Session::all()) --}}

        {{-- get the role and permission array --}}
        {{-- @php
          $role = App\Models\Role::where('role', Session::get('admin_role'))->first(); // ei admin er data
          $role_permissions = [];
          if($role != null && $role->permissions != null){
            $role_permissions = json_decode($role->permissions); // ei admin er ei roler permission ki ki
          }
        @endphp --}}

        {{-- admins --}}
        {{-- @if (Session::get('admin_role') == 'admin' || in_array('role', $role_permissions)) --}}

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::is('admin/admin*') ? 'show-sub' : '' }}">
                <i class="menu-item-icon icon ion-android-person tx-24"></i>
                <span class="menu-item-label">Category</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" style="{{ Request::is('admin/category*') ? 'display: block;' : 'display: none;' }}">

                <li class="sub-item">
                    <a href="{{ url('/admin/category/manage') }}"
                        class="sub-link {{ Request::is('admin/category/manage') ? 'active' : '' }}">Manage</a>
                </li>

                <li class="sub-item">
                    <a href="{{ url('/admin/category/create') }}"
                        class="sub-link {{ Request::is('admin/category/add') ? 'active' : '' }}">Add</a>
                </li>

            </ul>
        </li>

        {{-- @endif --}}

        {{-- @if (Session::get('admin_role') == 'admin' || in_array('department', $role_permissions)) --}}
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::is('admin/admin*') ? 'show-sub' : '' }}">
                <i class="menu-item-icon icon ion-android-list tx-24"></i>
                {{-- <i class="menu-item-icon fa fa-star tx-16"></i> --}}
                <span class="menu-item-label">Brand</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" style="{{ Request::is('admin/brand*') ? 'display: block;' : 'display: none;' }}">

                <li class="sub-item">
                    <a href="{{ url('admin/brand/manage') }}"
                        class="sub-link {{ Request::is('admin/brand/manage') ? 'active' : '' }}">Manage</a>
                </li>

                {{-- @if ($role->role == 'admin' || $role->role == 'stuff') --}}
                <li class="sub-item">
                    <a href="{{ url('admin/brand/create') }}"
                        class="sub-link {{ Request::is('admin/brand/create') ? 'active' : '' }}">Add</a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}

        {{-- @if (Session::get('admin_role') == 'admin' || in_array('teacher', $role_permissions)) --}}
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::is('admin/admin*') ? 'show-sub' : '' }}">
                <i class="menu-item-icon icon ion-android-person tx-24"></i>
                {{-- <i class="menu-item-icon fa fa-star tx-16"></i> --}}
                <span class="menu-item-label">Product</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" style="{{ Request::is('admin/product*') ? 'display: block;' : 'display: none;' }}">

                <li class="sub-item">
                    <a href="{{ url('admin/product/manage') }}"
                        class="sub-link {{ Request::is('admin/product/manage') ? 'active' : '' }}">Manage</a>
                </li>

                {{-- @if ($role->role == 'admin' || $role->role == 'stuff') --}}
                <li class="sub-item">
                    <a href="{{ url('admin/product/create') }}"
                        class="sub-link {{ Request::is('admin/product/create') ? 'active' : '' }}">Add</a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Session::get('admin_role') == 'admin' || in_array('stuff', $role_permissions)) --}}
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::is('admin/order*') ? 'show-sub' : '' }}">
                <i class="menu-item-icon icon ion-android-person tx-24"></i>
                {{-- <i class="menu-item-icon fa fa-star tx-16"></i> --}}
                <span class="menu-item-label">Orders</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" style="{{ Request::is('admin/order*') ? 'display: block;' : 'display: none;' }}">

                <li class="sub-item">
                    <a href="{{ url('admin/order/manage') }}"
                        class="sub-link {{ Request::is('admin/order/index') ? 'active' : '' }}">Manage</a>
                </li>
            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Session::get('admin_role') == 'admin' || in_array('student', $role_permissions)) --}}
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::is('admin/admin*') ? 'show-sub' : '' }}">
                <i class="menu-item-icon icon ion-android-person tx-24"></i>
                {{-- <i class="menu-item-icon fa fa-star tx-16"></i> --}}
                <span class="menu-item-label">Users</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" style="{{ Request::is('admin/student*') ? 'display: block;' : 'display: none;' }}">

                <li class="sub-item">
                    <a href="{{ url('admin/student/index') }}"
                        class="sub-link {{ Request::is('admin/student/index') ? 'active' : '' }}">Manage</a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Session::get('admin_role') == 'admin' || in_array('post', $role_permissions)) --}}
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::is('admin/admin*') ? 'show-sub' : '' }}">
                <i class="menu-item-icon icon ion-compose tx-24"></i>
                {{-- <i class="menu-item-icon fa fa-star tx-16"></i> --}}
                <span class="menu-item-label">Settings</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" style="{{ Request::is('admin/post*') ? 'display: block;' : 'display: none;' }}">

                <li class="sub-item">
                    <a href="{{ url('admin/post/index') }}"
                        class="sub-link {{ Request::is('admin/post/index') ? 'active' : '' }}">Manage</a>
                </li>

                {{-- @if ($role->role == 'admin' || $role->role == 'stuff') --}}
                <li class="sub-item">
                    <a href="{{ url('admin/post/create') }}"
                        class="sub-link {{ Request::is('admin/post/create') ? 'active' : '' }}">Add</a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Session::get('admin_role') == 'admin' || in_array('account', $role_permissions)) --}}
        {{-- @endif --}}

    </ul><!-- br-sideleft-menu -->
    <br>
</div><!-- br-sideleft -->
