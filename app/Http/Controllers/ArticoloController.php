<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marca;
use App\Models\articolo;
use App\Models\magazzino;
use App\Models\tipologia;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

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

        $tipologias = tipologia::get()->pluck('nome','id');
        $marcas = marca::get()->pluck('nome','id');
        return view('AggiungiArticoli', compact('tipologias','marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //nella prima parte prendiamo la tabella articolo
        $articolo = new articolo;
        //crea un nuovo elemento nella tabella articolo
        $articolo::create([
            'lean' => $request->input("lean"),
            'sku'=>$request->input("sku"),
            'tipologia_id'=>$request->input("tipologia_id"),
            'marca_id'=>$request->input("marca_id"),
            'descrizione'=>$request->input("descrizione"),
        ]);
        //prende l'elemento un elemento unico dalla richiesta per fare la query
        //che ritornerà l'id necessario per inserire l'articolo appena
        //creato anche all'interno la tabella magazzino
        $lean = $request->input("lean");
        $magazzino = new magazzino;
        $query = DB::select('select id from articolos where lean = ?', [$lean]);
        $arr = (object)$query[0];
        // dd($arr->id);id=>'29'

        $magazzino::create([
            'articolo_id'=>$arr->id
        ]);
        //infine il redirect ci riporta alla tabella magazzino dove potremo
        //vedere l'elemento appena creato
        return redirect('/magazzino');
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
