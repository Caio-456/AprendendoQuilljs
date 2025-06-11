<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use Inertia\Inertia;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postagens = Postagem::all();
        return Inertia::render('Index', compact('postagens'));
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
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
        ]);

        Postagem::create($request->all());

        return redirect()->route('postagem.index')->with('success', 'Postado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postagem $postagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postagem $postagem)
    {
        return Inertia::render('Edit', ['postagem'=>$postagem]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postagem $post)
    {
         $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
        ]);

        $postagem->update($request->all());

        return redirect()->route('postagem.index')->with('success', 'Postagem atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postagem $postagem)
    {
        $postagem->delete();
        return redirect()->route('postagem.index')->with('success', 'Postagem apagada.');
    }
}
