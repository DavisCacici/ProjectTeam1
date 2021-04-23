<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marca;
use App\Models\articolo;
use App\Models\magazzino;
use App\Models\tipologia;

class ArticoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AggiungiArticoli');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lean = $request -> input ('lean');
        $sku = $request -> input ('sku');
        $tipologia =  $request -> input ('tipologia');
        $marca = $request -> input ('marca');
        $descrizione = $request -> input ('descrizione');

        $tip = new tipologia;
        foreach($tip as $t)
        {
            if($tipologia == $t->nome)
            {

            }
        }


        $tip->create([
            'nome'=>$tipologia
        ]);

        $mar = new marca;
        $mar->create([
            'nome'=>$marca
        ]);

        $art = new articolo;
        $art->create([
            'lean'=>$lean,
            'sku'=>$sku,
            'descrizione'=>$descrizione
        ]);





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
