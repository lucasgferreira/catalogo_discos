@extends('adminlte::page')

@section('title', 'Discos')

@section('content_header')
    <h1>Categorias</h1>

@stop

@section('content')


    <div class="box">

        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <th><h4><strong>Categoria</strong></h4></th>
                    <th style="width: 80px;"></th>
                    <th style="width: 80px;"></th>
                </tr>


                @foreach($categorias as $categoria)

                    <tr>
                        <td><h4>{{ $categoria->nome }}</h4></td>
                        <td>
                            <a class="btn btn-success btn-block" href="{{route('categoria.edit', $categoria->id)}}"><i
                                        class="fa fa-edit"></i> Editar</a>
                        </td>
                        <td>
                            <button data-toggle="modal" data-target="#{{$categoria->id}}"
                                    class="btn btn-danger btn-block"><i
                                        class="fa fa-trash"></i> Excluir
                            </button>
                        </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="{{$categoria->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title"><strong>{{$categoria->nome}}</strong></h4>
                                </div>
                                <div class="modal-body">

                                    <h3 class="profile-username text-center">Excluir a
                                        categoria: {{$categoria->nome}}</h3>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <form method="post" action="{{route('categorias.destroy', $categoria->id)}}">
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


                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



    {!! $categorias->links() !!}
@stop