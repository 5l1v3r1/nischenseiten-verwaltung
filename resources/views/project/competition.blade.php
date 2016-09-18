@extends('layouts.fullwidth')

@section('content')
<div class="row">    
    @if( Session::get('project.id') )

    @include('project.sidebar')

    <div class="col-xs-10">

        <div id="top-buttons" class="row">           
            <div class="col-lg-12">
                <button id="add-projectcompetition" class="btn btn-success"><i class="fa fa-plus"></i> Neu</button>
            </div>
        </div>

        @if(count($competition)>0)



        <div id="projectcompetition-panel" class="panel panel-default">

            <div class="table-responsive">
                <table id="projectcompetition-table" class="table table-striped table-hover tablesorter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>URL</th>
                            <th>Stärke</th>
                            <th>Notiz</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('partials.project.competition-tr',$competition,'competition')
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
<script src="/js/plugins/tablesorter.min.js"></script> 
<script src="/js/project/competition.add.js"></script>
<script src="/js/project/competition.editables.js"></script>
<script src="/js/project/competition.delete.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('js.inline.code') 
<script>
    $(document).ready(function () {
        $("#projectcompetition-table").tablesorter({
            sortList: [[0, 1]],
            headers: {
                1: {
                    sorter: false
                },
                3: {
                    sorter: false
                },
                4: {
                    sorter: false
                }
            },
            textExtraction: function (node) {

                if ($(node).hasClass('star-rated-value')) {
                    return $(node).find('a').data('value');
                } else {
                    return node.innerHTML;
                }
            }
        });
    });
</script>
@endsection

@section('page.title')
Konkurrenz - Projekt
@endsection