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
        $lean = $request->input('articolo[lean]');
        $articolo = new articolo;
        $articolo::create($request->input("articolo"));
        $magazzino = new magazzino;
        $query = $articolo->where('lean', '=', $lean)->value('id');
        dd($query);
        // $magazzino::create([
        //     'articolo_id'=>$query
        // ]);

        // return redirect('/magazzino');
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
