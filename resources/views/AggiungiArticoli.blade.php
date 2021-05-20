@extends('layouts.navbar')
@section('title', 'New Articolo')
@section('content')
	<div class="row">
        <div class="col">
            <div class="container left">
                <form method="POST" action="">
                    @csrf
                    <div class="row">
                        <h3>Aggiungi nuovo Articolo</h3>
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Ean" name='code'>
                                <datalist id="datalistOptions">
                                @foreach($code as $k=>$v)
                                    <option value='{{$v}}'>
                                @endforeach
                                </datalist>
                            </div>

                            <div class="form-group">
                                <div class="left-inner-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <input class="form-control focus" type="text" placeholder="quantita" name="quantita">
                                </div>
                            </div>

                            <div class="button">
                                <button class="btn btn-success primo" type="submit" id="button">Aggiungi Articolo</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col">
            <div class="container right">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <h3>Aggiungi nuovo Codice</h3>
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <div class="left-inner-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <input class="form-control focus" type="text" placeholder="ean" name="ean">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="left-inner-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <input class="form-control focus" type="text" placeholder="sku" name="sku">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="left-inner-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <input class="form-control focus" type="text" placeholder="descrizione" name="descrizione">
                                </div>
                            </div>

                            <div class="button">
                                <button class="btn btn-success secondo " type="submit" id="button">Aggiungi Nuovo Codice</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
