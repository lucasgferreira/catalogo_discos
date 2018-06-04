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
                <li class="header">DISCOS</li>
                <li class="{{ Request::is('disco/cadastrar_discos') ? 'active' : '' }}">
                    <a href="{{route('disco.create')}}">
                        <i class="fa fa-fw fa-headphones"></i>
                        <span>Cadastrar disco</span>
                    </a>
                </li>
            @endif
            <li class="{{ Request::is('disco/discos') ? 'active' : '' }}">
                <a href="{{route('disco.discos')}}">
                    <i class="fa fa-fw ion-disc"></i>
                    <span>Meus discos</span>
                </a>
            </li>
            @if( Auth::user()->isAdmin )
                <li class="header">ARTISTA</li>
                <li class="{{ Request::is('artista/cadastrar_artista') ? 'active' : '' }}">
                    <a href="{{route('artista.create')}}">
                        <i class="fa fa-fw fa-user-plus"></i>
                        <span>Cadastrar artista</span>
                    </a>
                </li>

                <li class="{{ Request::is('artista/artistas') ? 'active' : '' }}">
                    <a href="{{route('artista.artistas')}}">
                        <i class="fa fa-fw fa-microphone"></i>
                        <span>Artistas</span>
                    </a>
                </li>
            @endif

            @if( Auth::user()->isAdmin )
                <li class="header">CATEGORIA</li>
                <li class="{{ Request::is('categoria/cadastrar_categoria') ? 'active' : '' }}">
                    <a href="{{route('categoria.create')}}">
                        <i class="fa fa-fw fa-search-plus"></i>
                        <span>Cadastrar categoria</span>
                    </a>
                </li>

                <li class="{{ Request::is('categoria/categorias') ? 'active' : '' }}">
                    <a href="{{route('categoria.categorias')}}">
                        <i class="fa fa-fw fa-filter"></i>
                        <span>Categorias</span>
                    </a>
                </li>
            @endif

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