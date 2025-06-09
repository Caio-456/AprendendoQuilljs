<?php

namespace App\Http\Controllers;
use App\Models\Mineral;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse; 
use Inertia\Inertia;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postagens = Mineral::with('fotos')->get();
        return Inertia::render('Dashboard/Minerais/Index', ['postagens'=>$postagens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mineral = new Mineral;
        $mineral -> nome = $request -> nome;
        $mineral -> descricao = $request -> descricao;
        $mineral -> propriedades = $request -> propriedades;
        $mineral -> save();
        
        if ($request->hasFile('foto')) {
            $fotosRequest = new Request([
                "idMineral" => $mineral->id,
                "capa_nome" => $request->input('capa_nome'),
            ]);

            // Encaminha os arquivos
            $fotosRequest->files->set('foto', $request->file('foto'));

            // Chama o controller de fotos
            app(\App\Http\Controllers\FotosController::class)->store($fotosRequest);
        }
        return redirect('/postagens/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mineral = Mineral::with('fotos')->findOrFail($id);
        return Inertia::render('Dashboard/Minerais/Edit', ['mineral' => $mineral]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mineral $mineral)
    {
        $mineral = Mineral::with('fotos')->findOrFail($request->id);
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'propriedades' => 'nullable|string',
        ]);

        // Atualizando apenas os campos que foram enviados
        if ($request->filled('nome')) {
            $mineral->nome = $request->nome;
        }

        if ($request->filled('descricao')) {
            $mineral->descricao = $request->descricao;
        }

        if ($request->filled('propriedades')) {
            $mineral->propriedades = $request->propriedades;
        }

        $mineral->save();

        return redirect()->route('postagens.index')->with('success', 'Mineral atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mineral)
    {
        $mineral = Mineral::findOrFail($mineral);  // Buscar o mineral, antes de alterar os dados
        foreach ($mineral->fotos as $foto) {
            app(\App\Http\Controllers\FotosController::class)->destroy($foto->id);

        }
        
        $mineral->delete();
        $postagens = Mineral::paginate(10);  // 10 rochas por página

        return redirect()->route('postagens.index', 'minerals')->with('success', 'Mineral deletado com sucesso!');
    }
    public function site(){
        $postagens = Mineral::with("fotos")->get();
        return view('Minerais',compact("postagens"));
    
    }

}
