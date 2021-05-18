@extends('layouts.navbar')
@section('title', 'Vendi')
@section('content')
        <main>
            <!-- in questa sezione passando l'id e la quantità dalla riga della tabella magazzino si possono inserire
                la quantità di un certo prodotto (che abbiamo richiamato con l'ID) che si vuole eliminare e passare questo dato al controller (LogisticsController) -->
            <h3>Questo manovra registrerà come venduta la quantità da lei indicata dal negozio</h3>
            <form method="POST" action="/vendi/{{$id}}/{{$quantita}}">
                @csrf
                <p>Quantità disponibile {{$quantita}}</p>
                <input type="text" name="numero"/>
                <button type="submit" class="btn btn-primary">Vendi</button>
            </form>
        </main>
@endsection
