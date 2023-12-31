<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">WMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->user_icon }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->user_name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>ダッシュボード</p>
                    </a>
                </li>

                <li class="nav-item">
                    @php
                    $userType = Auth::user()->user_type;
                    @endphp

                    <a href="{{ route('jobs.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>案件管理</p>
                    </a>
                </li>

                <li class="nav-item">
                    @if ($userType === 2)
                    <a href="{{ route('invoices.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>請求管理</p>
                    </a>
                    @elseif ($userType === 1)
                    <a href="{{ route('adminIndex') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>請求管理</p>
                    </a>
                    @endif
                </li>

                <li class="nav-item">
                    <a href="{{ route('announcements.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>お知らせ管理</p>
                    </a>
                </li>
                @if (Auth::user()->user_type === 1)
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>ユーザー管理</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('unreadDm') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>DM管理</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>