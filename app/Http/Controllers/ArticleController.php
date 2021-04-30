<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Article;
use App\Models\Warehouse;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
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

        $tipologias = Type::get()->pluck('type','id');
        $marcas = Brand::get()->pluck('brand','id');
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
        $articolo = new Article;
        //crea un nuovo elemento nella tabella articolo
        $articolo::create([
            'ean' => $request->input("ean"),
            'sku'=>$request->input("sku"),
            'type_id'=>$request->input("type_id"),
            'brand_id'=>$request->input("brand_id"),
            'descrizione'=>$request->input("descrizione"),
        ]);
        //prende l'elemento un elemento unico dalla richiesta per fare la query
        //che ritornerà l'id necessario per inserire l'articolo appena
        //creato anche all'interno la tabella magazzino
        $ean = $request->input("ean");
        $magazzino = new Warehouse;
        $query = DB::select('select id from articles where ean = ?', [$ean]);
        $arr = (object)$query[0];
        // dd($arr->id);id=>'29'

        $magazzino::create([
            'article_id'=>$arr->id
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
