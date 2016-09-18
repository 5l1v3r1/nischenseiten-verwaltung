@extends('layouts.fullwidth')

@section('content')
<div class="row">

    @if( Session::get('project.id') )

    @include('project.sidebar')

    <div class="col-xs-10">

        <div id="top-buttons" class="row">           
            <div class="col-lg-12">
                <button id="add-projectkeyword" class="btn btn-success"><i class="fa fa-plus"></i> Neu</button>
            </div>
        </div>

        @if(count($keyword)>0)



        <div id="projectkeyword-panel" class="panel panel-default">

            <div class="table-responsive">
                <table id="projectkeyword-table" class="table table-striped table-hover tablesorter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Keyword</th>
                            <th>Content?</th>
                            <th>SV</th>
                            <th>CPC</th>
                            <th>Comp.</th>
                            <th>Notiz</th>
                            @if( $api->value != '' )
                            <th></th>
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('partials.project.keyword-tr',$keyword,'keyword')
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
<script src="/js/project/keyword.add.js"></script>
<script src="/js/project/keyword.editables.js"></script>
<script src="/js/project/keyword.delete.js"></script>
@if( $api->value != '' )
<script src="/js/project/keyword.check.js"></script>
@endif

@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('js.inline.code') 
<script>
    $(document).ready(function () {
        $("#projectkeyword-table").tablesorter({
            sortList: [[0, 1]],
            headers: {
                6: {
                    sorter: false
                },
                7: {
                    sorter: false
                },
                8: {
                    sorter: false
                }
            }
        });
    });
</script>
@endsection

@section('page.title')
Keywords - Projekt
@endsection