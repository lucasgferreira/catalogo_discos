@extends('adminlte::page')

@section('title', 'Discos')

@section('content_header')
    <h1>Discos</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-12">
            @foreach($discos as $disco)

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box box-success">

                        <img class="img-responsive pad" src="{{ url("storage/capas/{$disco->capa}") }}"
                             alt="{{ $disco->album }}">

                        <div class="box-body">

                            <h3 class="profile-username text-center">Álbum: {{$disco->album}}</h3>

                            <p class="text-dark text-center">Artista: {{$disco->artista}}</p>

                            <p class="text-muted text-center">Gênero: {{$disco->categoria}}</p>

                        </div>
                        @if( Auth::user()->isAdmin )
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col col-xs-12 col-md-6">
                                        <a class="btn btn-success btn-block" href="{{route('disco.edit', $disco->id)}}"><i
                                                    class="fa fa-edit"></i> Editar</a>
                                    </div>

                                    <div class="col col-xs-12 col-md-6">

                                        <button data-toggle="modal" data-target="#{{$disco->id}}"
                                                class="btn btn-danger btn-block"><i
                                                    class="fa fa-trash"></i> Excluir
                                        </button>
                                    </div>

                                </div>
                            </div>
                    @endif
                    <!-- /.box-body -->
                    </div>
                </div>

                @if( Auth::user()->isAdmin )
                <!-- Modal -->
                    <div class="modal fade" id="{{$disco->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Excluir o disco: <strong>{{$disco->album}}</strong></h4>
                                </div>
                                <div class="modal-body">

                                    <img class="img-responsive pad" src="{{ url("storage/capas/{$disco->capa}") }}"
                                         alt="{{ $disco->album }}">

                                    <h3 class="profile-username text-center">Álbum: {{$disco->album}}</h3>

                                    <p class="text-dark text-center">Artista: {{$disco->artista}}</p>

                                    <p class="text-muted text-center">Gênero: {{$disco->genero}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <form method="post" action="{{route('discos.destroy', $disco->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger"><i
                                                    class="fa fa-trash"></i> Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                @endif


            @endforeach
        </div>
    </div>



    {!! $discos->links() !!}
@stop