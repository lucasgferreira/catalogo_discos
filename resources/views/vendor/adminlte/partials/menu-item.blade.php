<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MENU</li>
            <li class="{{ Request::is('admin/home') ? 'active' : '' }}">
                <a href="{{route('admin.home')}}">
                    <i class="fa fa-fw fa-dashboard "></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if( Auth::user()->isAdmin )
            <li class="{{ Request::is('admin/cadastrar_discos') ? 'active' : '' }}">
                <a href="{{route('admin.create')}}">
                    <i class="fa fa-fw fa-headphones "></i>
                    <span>Cadastrar</span>
                </a>
            </li>
            @endif
            <li class="{{ Request::is('admin/discos') ? 'active' : '' }}">
                <a href="{{route('admin.discos')}}">
                    <i class="fa fa-fw fa-headphones "></i>
                    <span>Meus discos</span>
                </a>
            </li>
            <li class="header">ACCOUNT SETTINGS</li>
            <li class="{{ Request::is('admin/user') ? 'active' : '' }}">
                <a href="{{route('admin.user')}}">
                    <i class="fa fa-fw fa-user "></i>
                    <span>Admin</span>
                </a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>