@extends('layouts.fullwidth')

@section('content')

<div id="top-buttons" class="row">
    <div class="col-lg-12">
        <button id="add-category" class="btn btn-success"><i class="fa fa-plus"></i> Neu</button>
    </div>
</div>

@if( $categories->count()>0 )

<div id="category-panel" class="panel panel-default">

    <div class="table-responsive">
        <table id="category-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategorie</th>
                    <th>Ideen</th>
                    <th>Notizen</th>
                    <th>Besitzer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @each('partials.categories.category-tr',$categories,'cat')
            </tbody>
        </table>
    </div>

</div>

@else

@include('partials.categories.empty')

@endif
<div id="message" class="alert"></div>

@endsection

@section('js.files')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/categories/add.js"></script>
<script src="/js/categories/editables.js"></script>
<script src="/js/categories/delete.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

@endsection

@section('js.inline.code') 

@endsection

@section('page.title')
Kategorie - Einstellungen
@endsection