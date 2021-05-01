<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Shop;
use App\Models\Historic;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::select('SELECT shops.id, articles.ean, articles.sku,
                                    types.type, brands.brand, articles.descrizione
                            FROM shops, articles, types, brands
                            WHERE shops.article_id = articles.id
                            AND articles.type_id = types.id
                            AND articles.brand_id = brands.id');
        $query = (object)$query;
        // dd($query);
        return view('negozio', compact('query'));
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
        $neg = new Shop;
        $neg = $neg->find($id);
        $neg->delete();

        return redirect('/negozio');
    }

    public function venduto($id)
    {
        $neg = new Shop;
        $storico = new Historic;
        $neg = $neg->find($id);

        $storico->create([
            'article_id' => $neg->article_id,
            'date'=>date('Y/m/d')
        ]);
        $neg->delete();

        return redirect('/storico');
    }

    public function cerca(Request $request)
    {
        $conteggio = 0;
        $cerca = (string)$request->input('ricerca');
        $query = DB::select('SELECT COUNT(shops.id) conta, shops.id, articles.ean, articles.sku, types.type, brands.brand, articles.descrizione
                             FROM shops, articles, types, brands
                             WHERE shops.article_id = articles.id
                             AND articles.type_id = types.id
                             AND articles.brand_id = brands.id
                             AND (types.type LIKE ?
                             OR brands.brand LIKE ?
                             OR articles.sku LIKE ?
                             OR articles.ean LIKE ?
                             OR articles.descrizione LIKE ?)
                             GROUP BY shops.id', [$cerca, $cerca, $cerca, $cerca, $cerca]);

        $query = (object)($query);
        foreach($query as $q)
        {
            $conteggio += $q->conta;
        }


        return view('ricerca', compact('query', 'conteggio'));

    }

}
