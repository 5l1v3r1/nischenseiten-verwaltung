@extends('layouts.fullwidth')

@section('content')
<div class="row">

    @if( Session::get('project.id') )

    @include('project.sidebar')

    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">

        <div id="top-buttons" class="row">
            <div class="col-xs-12 col-sm-4 col-md-2">
                <button id="update-ranking" class="btn btn-success pull-left"><i class="fa fa-refresh"></i> Ranking aktualisieren</button>
            </div>
            @if(count($keywords)>0)
            <div class="col-xs-12 col-sm-8 col-md-10 hidden-sm hidden-xs">
                <div class="well">Die Daten werden über die API von <a target="_blank" href="https://metrics.tools/x/hufe">metrics.tools</a> aktualisiert. Jedes aktualisierte Keyword kostet <em>1 Credit</em>, aktuell hast du noch <strong>{{$option->credits}}</strong> Credits. Die Sortierung erfolgt nach Traffic (absteigend), d.h. die Keywords ganz oben sind für dieses Projekt am relevantesten. Im Allgemeinen sollte man die Liste 1x pro Woche aktualisieren.</div>
            </div>
            @endif
        </div>

        @if(count($keywords)>0)

        <div id="ranking-panel">

            <div>
                <table id="ranking-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Keyword</th>
                            <th>Position</th>
                            <th>Diff.</th>
                            <th>SV</th>
                            <th>CPC</th>
                            <th>Comp.</th>
                            <th>URL</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('partials.project.ranking-tr',$keywords,'keyword')
                    </tbody>
                </table>
            </div>

        </div>

        @else

        @include('partials.project.empty')

        @endif
        <div id="message" class="alert"></div>

    </div>

    @else
    <div class="col-lg-12">
        <div class="alert alert-danger"><i class="fa fa-warning"></i> Bevor du die Projektmanagement-Funktionen nutzen kannst, musst du oben rechts in der Navigation auswählen, welches Projekt du verwalten willst.</div>
    </div>

    @endif
</div>
@endsection

@section('js.files')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="/js/project/rankings.update.js"></script>
@endsection

@section('css.files')
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endsection

@section('js.inline.code') 
<script>
    $(document).ready(function () {
        $('#ranking-table').DataTable();
    });
</script>
@endsection

@section('page.title')
Ranking - Projekt
@endsection