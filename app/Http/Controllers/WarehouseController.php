<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::select('SELECT warehouses.id, articles.ean, articles.sku, types.type,
                                    brands.brand, articles.descrizione
                            FROM warehouses, articles, types, brands
                            WHERE warehouses.article_id = articles.id
                            AND articles.type_id = types.id
                            AND articles.brand_id = brands.id');
        $query = (object)$query;
        // dd($query);
        return view('magazzino', compact('query'));
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
        $mag = new Warehouse;
        $mag = $mag->find($id);
        $mag->delete();

        return redirect('/magazzino');
    }

    public function sposta($id)
    {
        $neg = new Shop;
        $mag = new Warehouse;
        $mag = $mag->find($id);

        $neg->create([
            'article_id' => $mag->article_id
        ]);
        $mag->delete();

        return redirect('/magazzino');
    }

    public function cerca(Request $request)
    {
        $conteggio = 0;
        $cerca = (string)$request->input('ricerca');
        $query = DB::select('SELECT COUNT(warehouses.id) conta, warehouses.id, articles.ean, articles.sku, types.type, brands.brand, articles.descrizione
                             FROM warehouses, articles, types, brands
                             WHERE warehouses.article_id = articles.id
                             AND articles.type_id = types.id
                             AND articles.brand_id = brands.id
                             AND (types.type LIKE ?
                             OR brands.brand LIKE ?
                             OR articles.sku LIKE ?
                             OR articles.ean LIKE ?
                             OR articles.descrizione LIKE ?)
                             GROUP BY warehouses.id', [$cerca, $cerca, $cerca, $cerca, $cerca]);

        $query = (object)($query);
        foreach($query as $q)
        {
            $conteggio += $q->conta;
        }


        return view('ricerca', compact('query', 'conteggio'));

    }
}
