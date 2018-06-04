@extends('adminlte::page')

@section('title', 'Discos')

@section('content_header')

    <div class="small-box bg-green">
        <div class="inner">
            <h3>Artista</h3>

            <p>
            <h4 class="modal-title">{!! $title !!}</h4>
            </p>
        </div>
        <div class="icon">
            <i style="font-size: 90%;" class="fa fa-microphone"></i>
        </div>


        <!-- Horizontal Form -->
        <div class="box box-success rounded-0">
            <!-- form start -->

        </div><!-- /.box -->

    </div>

@stop

@section('content')

    @if(isset($errors) && count($errors) > 0)

        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Atenção!</h4>
            @foreach($errors->all() as $erro)
                <p>{{$erro}}</p>
            @endforeach
        </div>

    @endif



    <div class="box bg-white">
        @if(isset($artista))

            <form class="form-horizontal text-black" method="post" action="{{route('artistas.update', $artista->id)}}"
                  enctype="multipart/form-data">
                {!! method_field('PUT') !!}
                @else
                    <form class="form-horizontal text-black" method="post" action="{{route('artistas.store')}}"
                          enctype="multipart/form-data">

                        @endif

                        {!! csrf_field() !!}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="artista" class="col-sm-2 control-label">Artista</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nome" id="nome"
                                           placeholder="Nome do artista"
                                           maxlength="150" value="{{$artista->nome or old('nome') }}">
                                </div>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-success pull-right">Salvar</button>
                        </div><!-- /.box-footer -->
                    </form>
    </div>

@stop