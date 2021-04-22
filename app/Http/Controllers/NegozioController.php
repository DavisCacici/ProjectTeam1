<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\articolo;
use App\Models\magazzino;
use App\Models\tipologia;
use App\Models\marca;
use App\Models\negozio;

class NegozioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $art = new articolo;
        $art = $art->get();
        //tip dati della tipologia
        $tip = new tipologia;
        $tip = $tip->get();
        //mar dati della marca
        $mar = new marca;
        $mar = $mar->get();
        $neg = new negozio;
        $neg = $neg->get();
        return view('negozio', compact('neg', 'art', 'tip', 'mar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $neg = new negozio();
        $neg = $neg->find($id);
        $neg->delete();

        return redirect('/negozio');
    }

}
