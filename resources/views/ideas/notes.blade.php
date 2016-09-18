@extends('layouts.fullwidth')

@section('content')


<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-edit"></i> Idee "{{$idea->name}}"</div>

    <form action="/ideas/notes" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="pk" value="{{$idea->id}}">
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label for="notes">Allgemeine Notizen zu dieser Idee:</label>
                        <textarea class="form-control" rows="10" id="notes" name="notes">{{$idea->notes}}</textarea>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <div class="well"><i class="fa fa-info-circle"></i> In diesem Feld solltest du allgemeines Notizen zu der Idee "{{$idea->name}}" nieder schreiben. Dinge, die man vielleicht bedenken sollte und die du in 2 Monaten vergessen hast.</div>
                </div>
            </div>

            <hr /> 
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label for="w_questions">W-Fragen, die dir bereits jetzt einfallen:</label>
                        <textarea class="form-control" rows="8" id="w_questions" name="w_questions">{{$idea->w_questions}}</textarea>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <div class="well"><i class="fa fa-info-circle"></i> Oft hat man direkt, wenn man eine Nische gefunden hat, recht gute Ideen, was sich potentielle Interessenten Fragen. In diesem Feld kannst du die beliebten "W Fragen" schonmal abspeichern, damit sie vorhanden sind, wenn du diese Nische angehen willst.</div>
                </div>
            </div>

            <hr /> 
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label for="competition">Konkurrenz - sofern vorhanden:</label>
                        <textarea class="form-control" rows="5" id="competition" name="competition">{{$idea->competition}}</textarea>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <div class="well"><i class="fa fa-info-circle"></i></span> Eventuell sind dir direkt bei der Recherche Konkurrenten aufgefallen, die in dieser Nische aktiv sind. Diese kannst du hier eintragen. Das erspart das Suchen, wenn es mit der Nische losgehen soll.</div>
                </div>
            </div>

            <hr /> 

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

</div>

@endsection

