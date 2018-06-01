<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DiscoFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Disco;
use Illuminate\Support\Facades\Storage;

class DiscosController extends Controller
{
    private $disco;

    private $categorias = [
        'Alternativo',
        'Axé',
        'Blues',
        'Bolero',
        'Bossa Nova',
        'Brega',
        'Clássico',
        'Country',
        'Cuarteto',
        'Cumbia',
        'Dance',
        'Disco',
        'Eletrônica',
        'Emocore',
        'Fado',
        'Folk',
        'Forró',
        'Funk',
        'Funk Internacional',
        'Gospel/Religioso',
        'Gótico',
        'Grunge',
        'Guarânia',
        'Hard Rock',
        'Hardcore',
        'Heavy Metal',
        'Hip Hop/Rap',
        'House',
        'Indie',
        'Industrial',
        'Infantil',
        'Instrumental',
        'J-Pop/J-Rock',
        'Jazz',
        'Jovem Guarda',
        'K-Pop/K-Rock',
        'Mambo',
        'Marchas/Hinos',
        'Mariachi',
        'Merengue',
        'MPB',
        'Música andina',
        'New Age',
        'New Wave',
        'Pagode',
        'Pop',
        'Pop Rock',
        'Post-Rock',
        'Power-Pop',
        'Rock Progressivo',
        'Psicodelia',
        'Punk Rock',
        'Ranchera',
        'R&B',
        'Reggae',
        'Reggaeton',
        'Regional',
        'Rock',
        'Rock and Roll',
        'Rockabilly',
        'Romântico',
        'Salsa',
        'Samba',
        'Samba Enredo',
        'Sertanejo',
        'Ska',
        'Soft Rock',
        'Soul',
        'Surf Music',
        'Tango',
        'Tecnopop',
        'Trova',
        'Velha Guarda',
        'World Music',
        'Zamba',
        'Zouk',
    ];

    public function __construct(Disco $disco)
    {
        $this->disco = $disco;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $discos = $this->disco->paginate(12);

        return view('admin.discos.discos', compact('discos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = $this->categorias;
        $title = "Cadastrar novo disco";

        return view('admin.discos.index', compact('title', 'categorias'));
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

        $dataForm['id_user']= auth()->user()->id;
        $insert = $this->disco->create($dataForm);

        if ($insert)
            return redirect()->route('admin.discos');
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
        $categorias = $this->categorias;
        $disco = $this->disco->findOrFail($id);

        $title = "Editar o disco: <strong>{$disco->album}</strong>";

        return view('admin.discos.index', compact('title', 'categorias', 'disco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscoFormRequest $request, $id)
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
            return redirect()->route('admin.discos');
        } else {
            return redirect()->route('admin.discos.edit', $id)->with(['errors' => 'Falha ao editar!']);
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
            return redirect()->route('admin.discos.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }

        if ($delete) {
            return redirect()->route('admin.discos');
        } else {
            return redirect()->route('admin.discos.destroy', $id)->with(['errors' => 'Falha ao excluir!']);
        }
    }
}
