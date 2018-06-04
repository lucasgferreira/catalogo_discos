<?php

namespace App\Http\Controllers\Disco;

use App\Http\Requests\DiscoFormRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscoFormRequestUpdate;
use App\Models\Artista;
use App\Models\Categoria;
use App\Models\Disco;
use Illuminate\Support\Facades\Storage;

class DiscoController extends Controller
{
    private $disco;
    private $categoria;
    private $artista;


    public function __construct(Disco $disco, Categoria $categoria, Artista $artista)
    {
        $this->disco = $disco;
        $this->categoria = $categoria;
        $this->artista = $artista;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $discos = $this->disco->join('categorias', 'discos.id_categoria', 'categorias.id')
            ->join('artistas', 'discos.id_artista', 'artistas.id')
            ->selectRaw('discos.id, discos.album, discos.capa, categorias.nome as categoria, artistas.nome as artista')
            ->paginate(12);

        return view('disco.discos', compact('discos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = $this->categoria->all();
        $artistas = $this->artista->all();
        $title = "Cadastrar novo disco";

        return view('disco.index', compact('title', 'categorias', 'artistas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscoFormRequest $request)
    {
        $dataForm = $request->except('_token');

        //$this->validate($request, $this->disco->rules, $this->disco->messages);

        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('capa') && $request->file('capa')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->capa->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $dataForm['capa']= $nameFile;

            // Faz o upload:
            $upload = $request->capa->storeAs('capas', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/capas/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();

        }

        $dataForm['id_user'] = auth()->user()->id;
        $insert = $this->disco->create($dataForm);

        if ($insert)
            return redirect()->route('disco.discos');
        else
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = $this->categoria->all();
        $artistas = $this->artista->all();
        $disco = $this->disco->findOrFail($id);

        $title = "Editar o disco: <strong>{$disco->album}</strong>";

        return view('disco.index', compact('title', 'categorias', 'disco', 'artistas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscoFormRequestUpdate $request, $id)
    {
        $dataForm = $request->all();
        $disco = $this->disco->find($id);


        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('capa') && $request->file('capa')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->capa->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $dataForm['capa']= $nameFile;

            // Faz o upload:
            $upload = $request->capa->storeAs('capas', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/capas/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();

        }

        $update = $disco->update($dataForm);


        if ($update) {
            return redirect()->route('disco.discos');
        } else {
            return redirect()->route('disco.discos.edit', $id)->with(['errors' => 'Falha ao editar!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disco = $this->disco->find($id);

        try {


            Storage::delete('capas/'.$disco->capa);

            $delete = $disco->delete();
        }catch (\Exception $e){
            return redirect()->route('disco.discos.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }

        if ($delete) {
            return redirect()->route('disco.discos');
        } else {
            return redirect()->route('disco.discos.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }
    }
}
