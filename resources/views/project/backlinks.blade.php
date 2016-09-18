@extends('layouts.fullwidth')

@section('content')
<div class="row">

    @if( Session::get('project.id') )

    @include('project.sidebar')

    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">

        <div id="top-buttons" class="row">           
            <div class="col-lg-6 col-md-6 col-xs-6">
                <button id="add-backlink" class="btn btn-success"><i class="fa fa-plus"></i> Neu</button>
            </div>
            
            <div class="col-lg-3 col-md-4 col-xs-6 pull-right">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input id="table-searchfilter" type="text" class="form-control" placeholder="Tabelle durchsuchen...">
                </div>
            </div>
        </div>

        @if(count($backlinks)>0)



        <div id="backlink-panel" class="panel panel-default">

            <div class="table-responsive">
                <table id="backlink-table" class="table table-striped table-hover tablesorter tablesearch">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Quelle</th>
                            <th>Ziel</th>
                            <th>Text</th>
                            <th>Relation</th>
                            <th>Status</th>
                            <th>Notiz</th>
                            <th>Prüfung</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('partials.project.backlink-tr',$backlinks,'backlink')
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
<script src="/js/plugins/tablefilter.min.js"></script> 
<script src="/js/plugins/tablesorter.min.js"></script> 
<script src="/js/project/backlink.add.js"></script>
<script src="/js/project/backlink.editables.js"></script>
<script src="/js/project/backlink.delete.js"></script>
<script src="/js/project/backlink.check.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('js.inline.code') 
<script>
    $(document).ready(function () {
        $("#backlink-table").tablesorter({
            sortList: [[0, 1]],
            headers: {
                5: {
                    sorter: false
                },
                6: {
                    sorter: false
                },
                8: {
                    sorter: false
                },
                9: {
                    sorter: false
                }
            }
        });
    });
</script>
@endsection

@section('page.title')
Backlinks - Projekt
@endsection