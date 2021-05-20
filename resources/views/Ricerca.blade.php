@extends('layouts.navbar')
@section('title', 'Ricerca')
@section('content')

<div class="row">
    <div class="col">
        <label class="label"><h1>{{$location}}</h1></label>
    </div>
</div>

<table class="table th">
    <thead class="thead-dark">
    <tr>
        <th scope="col" style="width: 200px" >EAN</th>
        <th scope="col" style="width: 200px">SKU</th>
        <th scope="col" style="width: 300px">DESCRIZIONE</th>
        <th scope="col" style="width: 200px">QUANTITA</th>
        @if($location == 'Storico')
            <th scope="col" style="width: 200px">DATA</th>
        @endif
        <th scope="col" class="td">&nbsp</th>
    </tr>
    </thead>

    @foreach ($query as $q)
        @if($q->quantita <= 10 && $location != 'Storico')
        <tr class='demo'>
            <td>{{$q->ean}}</td>
            <td>{{$q->sku}}</td>
            <td>{{$q->descrizione}}</td>
            <td>{{$q->quantita}}</td>
            @if($location == 'Storico')
                <td>{{$q->data}}</td>
            @endif
            <td class="button4 td ">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                @if($location != 'Storico')
                    <form method="GET" action="/elimina/{{$q->id}}/{{$q->quantita}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">elimina</button>
                    </form>
                @endif
                @if($location == 'Magazzino')
                    <form method="GET" action="/sposta/{{$q->id}}/{{$q->quantita}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">sposta&nbsp</button>
                    </form>
                @endif
                @if($location == 'Negozio')
                    <form method="GET" action="/vendi/{{$q->id}}/{{$q->quantita}}">
                        @csrf
                        <button type="submit"  class="btn btn-primary">vendi</button>
                    </form>
                @endif
                </div>
            </td>
        </tr>
        @else
        <tr>
            <td>{{$q->ean}}</td>
            <td>{{$q->sku}}</td>
            <td>{{$q->descrizione}}</td>
            <td>{{$q->quantita}}</td>
            @if($location == 'Storico')
                <td>{{$q->data}}</td>
            @endif
            <td class="button4 td ">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                @if($location != 'Storico')
                <form method="GET" action="/elimina/{{$q->id}}/{{$q->quantita}}">
                    @csrf
                    <button type="submit" class="btn btn-danger">elimina</button>
                </form>
                @endif
                @if($location == 'Magazzino')
                    <form method="GET" action="/sposta/{{$q->id}}/{{$q->quantita}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">sposta&nbsp</button>
                    </form>
                @endif
                @if($location == 'Negozio')
                    <form method="GET" action="/vendi/{{$q->id}}/{{$q->quantita}}">
                        @csrf
                        <button type="submit"  class="btn btn-primary">vendi</button>
                    </form>
                @endif
                </div>
            </td>
        </tr>
        @endif
    @endforeach
</table>
<script>
    jQuery(document).ready(function(){
        jQuery('.demo').css('background-color', 'orange');
    });
</script>
@endsection
