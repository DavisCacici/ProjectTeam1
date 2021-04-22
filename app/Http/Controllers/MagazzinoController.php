<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\articolo;
use App\Models\magazzino;
use App\Models\tipologia;
use App\Models\marca;
use App\Models\negozio;

class MagazzinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //art dati articoli
        $art = new articolo;
        $art = $art->get();
        //mag dati magazzino
        $mag = new magazzino;
        $mag = $mag->get();
        //tip dati della tipologia
        $tip = new tipologia;
        $tip = $tip->get();
        //mar dati della marca
        $mar = new marca;
        $mar = $mar->get();

        return view('magazzino', compact('art', 'mag', 'tip', 'mar'));
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
        $mag = new magazzino;
        $mag = $mag->find($id);
        $mag->delete();

        return redirect('/magazzino');
    }

    public function sposta($id)
    {
        $neg = new negozio;
        $mag = new magazzino;
        $mag = $mag->find($id);

        $neg->create([
            'articolo_id' => $mag->articolo_id
        ]);
        $mag->delete();

        return redirect('/magazzino');
    }
}
