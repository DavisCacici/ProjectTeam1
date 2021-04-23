<?php

namespace App\Http\Controllers;

use App\Models\storico;
use App\Models\articolo;
use App\Models\tipologia;
use App\Models\marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storico = new storico;
        $storico = $storico->get();
        $tipo = new tipologia;
        $tipo = $tipo->get();
        $marca = new marca;
        $marca = $marca->get();
        $art = new articolo;
        $art = $art->get();

        // $query = DB::table('storicos')
        // ->select('storicos.id', 'articolos.id', 'articolos.lean', 'articolos.sku', 'tipologias.nome', 'marcas.nome', 'storicos.data')
        // ->from('storicos','articolos', 'tipologias', 'marcas')
        // ->where('storicos.articolo_id', '=', 'articolos.id')
        // ->where('articolos.tipologia_id', '=', 'tipologias.id')
        // ->where('articolos.marcas_id', '=', 'marcas.id')
        // ->get();





        return view('ProdottiVenduti', compact('storico', 'art', 'tipo', 'marca'));
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
        //
    }
}
