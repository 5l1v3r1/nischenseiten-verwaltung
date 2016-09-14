@extends('layouts.fullwidth')

@section('content')

@if($ideas->count()>0)


<div class="row">
    <div class="col-lg-1">
        <button id="add-idea" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Neu</button>
    </div>  
    <div class="col-lg-11">
        <div id="idea-search" class="row">
            <form action="/ideas/index" method="POST">
                {{ csrf_field() }}
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="idea-category" id="idea-category">
                            <option value="0">Alle Kategorien</option>
                            @foreach(Auth::user()->categories as $cat)
                            @include('partials.ideas.idea-categories-option', ['cat' => $cat])
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sun-o"></i></span>
                        <select class="form-control" name="idea-seasonal" id="idea-seasonal">
                            <option value="-1">Saisonal</option>
                            <option @if($chosen_seasonal==0) selected="selected" @endif value="0">Nein</option>
                            <option @if($chosen_seasonal==1) selected="selected" @endif value="1">Ja</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                        <input value="@if($chosen_sv>0) {{$chosen_sv}} @endif" type="text" name="idea-min-sv" id="idea-min-sv" class="form-control" placeholder="Minimal SV">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                        <select class="form-control" name="idea-sorter" id="idea-sorter">
                            <option>Sortierung</option>
                            <option @if($chosen_sorter==0) selected="selected" @endif value="0">Erstelldatum</option>
                            <option @if($chosen_sorter==1) selected="selected" @endif value="1">Bearbeitungsdatum</option>
                            <option @if($chosen_sorter==2) selected="selected" @endif value="2">Suchvolumen</option>
                            <option @if($chosen_sorter==3) selected="selected" @endif value="3">CPC</option>
                            <option @if($chosen_sorter==4) selected="selected" @endif value="4">Geschätzte Kaufconversion</option>
                            <option @if($chosen_sorter==5) selected="selected" @endif value="5">Provision</option>
                            <option @if($chosen_sorter==6) selected="selected" @endif value="6">Potential: CPC</option>
                            <option @if($chosen_sorter==7) selected="selected" @endif value="7">Potential: PPP</option>
                            <option @if($chosen_sorter==8) selected="selected" @endif value="8">Persönliche Bewertung</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort"></i></span>
                        <select class="form-control" name="idea-sorter-order" id="idea-sorter-order">
                            <option @if($chosen_order==0) selected="selected" @endif value="0">Absteigend</option>
                            <option @if($chosen_order==1) selected="selected" @endif value="1">Aufsteigend</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group idea-search-submit-btn">
                        <button type="submit" class="btn btn-primary form-control" placeholder="Username"><i class="fa fa-search"></i> Filtern</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 

</div>

<div id="idea-panel" class="panel panel-default">

    <div class="table-responsive">
        <table id="idea-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Thema oder Hauptkeyword für diese Idee">Hauptkeyword</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Kategorie dieser Nischenidee">Kategorie</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Gesamtes Suchvolumen, was man nach erfolgreicher Umsetzung erwarten könnte">SV</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Kosten für einen Klick">CPC</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Durchschnittlicher Preis eines Produkts in der Nische">PPP</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Kaufconversion - so viel Prozent des Suchvolumens kaufen ein Produkt (PPP)/klicken auf Werbung (CPC)">BC</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-html="true" data-placement="top" title="Maximales Potential dieser Nische:<br /> a) Fall Bannerwerbung: SV*(BC/100)*CPC<br />b) Fall Affiliate: SV*(BC/100)*PPP*(Provision/100)">Potential</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Das Partnerprogramm/Netzwerk, mit dem wohl am meisten gehen wird">Partnerp.</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Für den Fall PPP die Provision pro Produktverkauf">Prov.</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Ist diese Nische eine saisonale Nische - nur Sommer/Winter?">Sais.</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Interessante Keywords zu dieser Idee, die man im Auge behalten sollte">Keywords</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Diese Domains sind noch frei und könnten für diese Idee verwendet werden.">Domains</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Deine Einschätzung zur Konkurrenz">Konkurrenz</span></th>
                    <th><span class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="Deine persönliche Bewertung zu dieser Nische auf einer Sterneskala: 1 Stern (schlecht) bis 5 Sterne (sehr gut)">Bewertung</span></th>
                    <th></th>
                    @if( $api->value != '' )
                    <th></th>
                    @endif
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @each('partials.ideas.idea-tr',$ideas,'idea')
            </tbody>
        </table>
    </div>

</div>

@else

@include('partials.ideas.empty')

@endif
<div id="message" class="alert"></div>

<div class="row">

    <div class="col-lg-3 ">
        <button id="add-idea-bottom" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Neu</button>
    </div>  

    <div class="col-lg-9 idea-pagination">
        <div class="pull-right">{{ $ideas->links() }}</div>
    </div> 

</div>



@endsection

@section('js.files')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/ideas/editables.js"></script>
<script src="/js/ideas/add.js"></script>
<script src="/js/ideas/delete.js"></script>
@if( $api->value != '' )
<script src="/js/ideas/check.js"></script>
@endif
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

@endsection

@section('js.inline.code') 
<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection


@section('page.title')
Ideen - Verwaltung/Archiv
@endsection