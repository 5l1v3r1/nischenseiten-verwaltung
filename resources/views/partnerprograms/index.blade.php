@extends('layouts.fullwidth')

@section('content')

<div id="top-buttons" class="row">
    <div class="col-lg-12">
        <button id="add-partnerprogram" class="btn btn-success"><i class="fa fa-plus"></i> Neu</button>
    </div>
</div>

@if($partnerprograms->count()>0)



<div id="partnerprogram-panel" class="panel panel-default">

    <div class="table-responsive">
        <table id="partnerprogram-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Partnerprogramm</th>
                    <th>Ideen</th>
                    <th>Notizen</th>
                    <th>Besitzer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @each('partials.partnerprograms.partnerprogram-tr',$partnerprograms,'pp')
            </tbody>
        </table>
    </div>

</div>

@else

@include('partials.partnerprograms.empty')

@endif
<div id="message" class="alert"></div>

@endsection

@section('js.files')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/partnerprograms/add.js"></script>
<script src="/js/partnerprograms/editables.js"></script>
<script src="/js/partnerprograms/delete.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

@endsection

@section('js.inline.code') 

@endsection

@section('page.title')
Partnerprogramme - Einstellungen
@endsection