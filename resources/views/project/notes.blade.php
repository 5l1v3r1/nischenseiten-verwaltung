@extends('layouts.fullwidth')

@section('content')
<div class="row">

    @if( Session::get('project.id') )

    @include('project.sidebar')

    <div class="col-xs-10">

        <div id="top-buttons" class="row">
            <div class="col-lg-6">
                <button id="add-projectnote" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Neu</button>
            </div>
            <div class="col-lg-6">
                @if(Session::get('project.notes.archived')==0)
                <a href="/project/notes/showarchived" class="btn btn-primary pull-right"><i class="fa fa-archive"></i> Archivierte anzeigen</a>
                @else
                <a href="/project/notes/hidearchived" class="btn btn-warning pull-right"><i class="fa fa-archive"></i> Archivierte verbergen</a>
                @endif
            </div>
        </div>

        @if(count($notes)>0)



        <div id="projectnotes-panel" class="panel panel-default">

            <div class="table-responsive">
                <table id="projectnotes-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Titel</th>
                            <th>Inhalt</th>
                            <th>Priorität</th>
                            <th>Deadline</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('partials.project.notes-tr',$notes,'note')
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
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/project/note.add.js"></script>
<script src="/js/project/note.editables.js"></script>
<script src="/js/project/note.delete.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('js.inline.code') 

@endsection

@section('page.title')
Notizen und Aufgaben - Projekt
@endsection