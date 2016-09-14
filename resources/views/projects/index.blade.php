@extends('layouts.fullwidth')

@section('content')

<div id="top-buttons" class="row">
    <div class="col-lg-12">
        <button id="add-project" class="btn btn-success"><i class="fa fa-plus"></i> Neu</button>
    </div>
</div>

@if( $projects->count()>0 )

<div id="project-panel" class="panel panel-default">

    <div class="table-responsive">
        <table id="project-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Projekt (URL)</th>
                    <th>Besitzer</th>
                    <th>Notizen</th>
                    <!--<th>Google Analytics<br />View ID</th>-->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @each('partials.projects.projects-tr',$projects,'project')
            </tbody>
        </table>
    </div>

</div>

<div class="alert alert-info"><i class="fa fa-warning"></i> Nach dem Hinzufügen oder Bearbeiten eines neuen Projekts, empfiehlt es sich die Seite komplett neu zu laden, damit z.B. die Elemente in der Sidebar neu geschrieben werden können.</div>

@else

@include('partials.projects.empty')

@endif
<div id="message" class="alert"></div>

@endsection

@section('js.files')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/projects/add.js"></script>
<script src="/js/projects/editables.js"></script>
<script src="/js/projects/delete.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

@endsection

@section('js.inline.code') 

@endsection


@section('page.title')
Projekte - Einstellungen
@endsection