@extends('layouts.navbar')
@section('title', 'HomePage')
@section('content')
        <div class="row">
            <div class="col">
                <label class="label"><h1>Magazzino</h1></label>
            </div>
            <div class="col cerca">
                <form method="GET" action="/ricerca/{{$magazzino}}">
                    <input type="text" name="ricerca" style="height: 35px">
                    <button type="submit" class="btn btn-success" style="height: 35px">cerca</button>
                </form>
            </div>
        </div>

        <table class="table th">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 200px" >EAN</th>
                <th scope="col" style="width: 200px" >SKU</th>
                <th scope="col" style="width: 300px" >DESCRIZIONE</th>
                <th scope="col" style="width: 200px" >QUANTITA'</th>
                <th scope="col" class="td">&nbsp</th>
              </tr>
            </thead>

            @foreach ($query as $q)
                @if($q->quantita <= 10)
                    <tr class='demo'>
                        <td>{{$q->ean}}</td>
                        <td>{{$q->sku}}</td>
                        <td>{{$q->descrizione}}</td>
                        <td>{{$q->quantita}}</td>
                        <td class="botton3 td" >
                            <form method="GET" action="/elimina/{{$q->id}}/{{$q->quantita}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">elimina</button>
                            </form>
                            <form method="GET" action="/sposta/{{$q->id}}/{{$q->quantita}}">
                                @csrf
                                <button type="submit" class="btn btn-primary">sposta&nbsp</button>
                            </form>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{$q->ean}}</td>
                        <td>{{$q->sku}}</td>
                        <td>{{$q->descrizione}}</td>
                        <td>{{$q->quantita}}</td>
                        <td class="botton3 td" >
                            <form method="GET" action="/elimina/{{$q->id}}/{{$q->quantita}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">elimina</button>
                            </form>
                            <form method="GET" action="/sposta/{{$q->id}}/{{$q->quantita}}">
                                @csrf
                                <button type="submit" class="btn btn-primary">sposta&nbsp</button>
                            </form>
                        </td>
                    </tr>
                @endif
                <script>
                    jQuery(document).ready(function(){
                        jQuery('.demo').css('background-color', 'orange');
                    });
                </script>
            @endforeach
        </table>
@endsection

