<?php

namespace App\Http\Controllers\Categoria;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaFormRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->middleware('auth');
    }


    public function index()
    {
        $categorias = $this->categoria->paginate(10);

        return view('categoria.categorias', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar nova categoria";

        return view('categoria.index', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaFormRequest $request)
    {
        $dataForm = $request->except('_token');


        $insert = $this->categoria->create($dataForm);

        if ($insert)
            return redirect()->route('categoria.categorias');
        else
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = $this->categoria->findOrFail($id);

        $title = "Editar a categoria: <strong>{$categoria->nome}</strong>";

        return view('categoria.index', compact('title','categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $categoria = $this->categoria->find($id);

        $update = $categoria->update($dataForm);

        if ($update) {
            return redirect()->route('categoria.categorias');
        } else {
            return redirect()->route('categoria.categorias.edit', $id)->with(['errors' => 'Falha ao editar!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = $this->categoria->find($id);

        try {

            $delete = $categoria->delete();
        }catch (\Exception $e){
            return redirect()->route('categoria.categorias.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }

        if ($delete) {
            return redirect()->route('categoria.categorias');
        } else {
            return redirect()->route('categoria.categorias.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }
    }
}
