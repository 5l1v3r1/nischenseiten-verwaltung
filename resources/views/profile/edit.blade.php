@extends('layouts.fullwidth')

@section('content')


<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-edit"></i> Nutzer aktualisieren</div>

    <form action="/user/profile" method="POST">
        {{ csrf_field() }}
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label>Voller Name:</label>
                        <input type="text" value="{{Auth::user()->name}}" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label>E-Mail-Adresse:</label>
                        <input type="text" value="{{Auth::user()->email}}" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label>E-Mail-Adresse (Wiederholung):</label>
                        <input type="text" value="{{Auth::user()->email}}" class="form-control" name="email_confirmation" id="email_confirmation">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label>Passwort:</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label>Passwort (Wiederholung):</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Aktualisieren</button>
                </div>
                <div class="col-lg-8">
                    <div id="flash">
                        @if (Session::has('status'))
                        <div class="alert alert-info">{{ Session::get('status') }}</div>
                        @endif
                    </div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

@endsection


@section('page.title')
Profil - Einstellungen
@endsection