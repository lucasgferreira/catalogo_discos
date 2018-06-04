<?php

namespace App\Http\Controllers\Artista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artista;
use App\Http\Requests\ArtistaFormRequest;

class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $artista;

    public function __construct(Artista $artista)
    {
        $this->artista = $artista;
        $this->middleware('auth');
    }

    public function index()
    {
        $artistas = $this->artista->paginate(10);

        return view('artista.artistas', compact('artistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar novo artista";

        return view('artista.index', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistaFormRequest $request)
    {
        $dataForm = $request->except('_token');


        //$dataForm['id_user']= auth()->user()->id;
        $insert = $this->artista->create($dataForm);

        if ($insert)
            return redirect()->route('artista.artistas');
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
        $artista = $this->artista->findOrFail($id);

        $title = "Editar o artista: <strong>{$artista->nome}</strong>";

        return view('artista.index', compact('title','artista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistaFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $artista = $this->artista->find($id);

        $update = $artista->update($dataForm);

        if ($update) {
            return redirect()->route('artista.artistas');
        } else {
            return redirect()->route('artista.artistas.edit', $id)->with(['errors' => 'Falha ao editar!']);
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
        $artista = $this->artista->find($id);

        try {

            $delete = $artista->delete();
        }catch (\Exception $e){
            return redirect()->route('artista.artistas.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }

        if ($delete) {
            return redirect()->route('artista.artistas');
        } else {
            return redirect()->route('artista.artistas.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }
    }
}
