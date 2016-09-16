@extends('layouts.fullwidth')

@section('content')



<form action="/settings/apis/index" method="POST">
    {{ csrf_field() }}


    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-edit"></i> API Keys aktualisieren</div>

                <div class="panel-body">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label>Key für <strong>metrics.tools</strong> (<a href="https://metrics.tools/x/hufe" target="_blank" >Hier entlang, falls du noch keinen hast</a>):</label>
                            <input placeholder="Hier kommt dein API-Key für die metrics.tools herein" type="text" value="{{$options->find(1)->value}}" class="form-control" name="apimetrics" id="apimetrics">
                            <br />
                            <div class="alert alert-warning">Der API Key hat noch <strong>{{$options->find(1)->credits}}</strong> Credits übrig!</div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="well">
                            <i class="fa fa-question-circle"></i> metrics.tools ist ein Online Tool, das diverse Daten (Suchvolumen, tagesaktuelle Positionen, CPC, ...) für eine URL oder ein Keyword bereit stellt. Es erleichtert die Analyse und Optimierung von Projekten ungemein, weshalb ich es wärmstens empfehlen kann. Wer sich bei mir bedanken will, der kann über meinen Ref-Link einen Account bestellen: <br /><a target="_blank" href="https://metrics.tools/x/hufe">metrics.tools/x/hufe</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-edit"></i> Backlink Checker</div>

                <div class="panel-body">


                    <div class="form-group">
                        <label class="col-md-4 control-label">Anzahl pro Durchlauf</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value ="{{$options->find(3)->value}}" name="backlink_count">
                        </div>
                        <div class="clearfix"></div>
                        <label class="col-md-4 control-label">Intervall (in Tagen)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$options->find(6)->value}}" name="backlink_ttl">
                        </div>
                    </div>
                    
                    

                </div>
                
                <div class="well"><i class="fa fa-question-circle"></i> Hier kannst du einstellen, in welchem Intervall jeder Backlink geprüft werden soll und wie viele Backlinks pro Aufruf des Cronjobs geprüft werden soll.</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-edit"></i> Projekt: Keywords</div>

                <div class="panel-body"> 

                    <div class="form-group">
                        <label class="col-md-4 control-label">Anzahl pro Durchlauf</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$options->find(4)->value}}" name="keyword_count">
                        </div>
                        <div class="clearfix"></div>
                        <label class="col-md-4 control-label">Intervall (in Tagen)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control"value="{{$options->find(7)->value}}"  name="keyword_ttl">
                        </div>
                    </div>

                </div>
                
                <div class="well"><i class="fa fa-question-circle"></i> In welchem Intervall sollen Suchvolumen, CPC und Konkurrenz für jedes Keyword (innerhalb eines Projekts) aktualisiert werden?</div>
                
            </div>
        </div>
        

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-edit"></i> Ideensammlung: Keywords</div>

                <div class="panel-body"> 

                    <div class="form-group">
                        <label class="col-md-4 control-label">Anzahl pro Durchlauf</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$options->find(5)->value}}" name="idea_count">
                        </div>
                        <div class="clearfix"></div>
                        <label class="col-md-4 control-label">Intervall (in Tagen)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$options->find(8)->value}}" name="idea_ttl">
                        </div>
                    </div>

                </div>
                
                <div class="well"><i class="fa fa-question-circle"></i> Hier kannst du einstellen, in welchem Intervall Suchvolumen, CPC und Konkurrenz für jede Idee aktualisiert werden sollen.</div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Aktualisieren</button>
        </div>

        <div id="optionmessages" class="col-lg-12">
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

</form>


@endsection


@section('page.title')
App - Einstellungen
@endsection