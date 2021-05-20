@extends('layouts.navbar')
@section('title', 'HomePage')
@section('content')

    <div class="container">
        <br>
        <div class="row">
            <h1>LOGIN</h1>
            <br>
            <br>
            <br>
            <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input class="form-control focus" type="text" placeholder="Nome" name="nome">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input class="form-control focus" type="text" placeholder="Cognome" name="cognome">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-envelope"></i>
                            <input class="form-control focus" type="text" placeholder="Email" name="email">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                            <input class="form-control focus" type="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <br>

                    <div class="button2">
                        <a class="btn btn-warning" href="">Accedi</a>
                    </div>
            </div>
        </div>
    </div>


@endsection
