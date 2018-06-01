@extends('adminlte::page')

@section('title', 'Home Dashboard')

@section('content_header')
    <h1>
        @if( Auth::check() )
            {{ Auth::user()->name }}
        @endif
    </h1>

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="">

        <!-- Main content -->
        <section class="content">


            <!-- /.col -->


            <div class="row">
                <div class="col-md-12">

                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                 src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-group-512.png"
                                 alt="User profile picture">


                            <h3 class="profile-username text-center">
                                @if( Auth::check() )
                                    {{ Auth::user()->name }}
                                @endif
                            </h3>

                            <p class="text-muted text-center">
                                @if( Auth::check() )
                                    {{ Auth::user()->email }}
                                @endif
                            </p>

                            <p class="text-muted text-center">
                                @if( Auth::check() )

                                    @if( Auth::user()->isAdmin )
                                        Administrador
                                    @else
                                        Funcionário
                                    @endif
                                @endif
                            </p>


                        </div>
                    </div><!-- /.box -->
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>



@stop