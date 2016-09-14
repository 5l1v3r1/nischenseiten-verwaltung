@extends('layouts.fullwidth')

@section('content')

<div id="dashboard" class="row">
    <div class="col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-diamond fa-4x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="large">{{ Auth::user()->projects->count() }} {!! ( Auth::user()->projects->count() != 1 ) ? 'eigene Projekte' : 'eigenes Projekt' !!}</div>
                        @if(Auth::user()->role->level > 90)
                        <div class="small">{{ \App\Project::all()->count() }} {!! ( \App\Project::all()->count() != 1 ) ? 'Projekte insgesamt' : 'Projekt insgesamt' !!}</div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="/settings/projects/index">
                <div class="panel-footer">
                    <span class="pull-left">Alle zeigen</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-lightbulb-o fa-4x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="large">{{ Auth::user()->ideas->count() }} {!! ( Auth::user()->ideas->count() != 1 ) ? 'eigene Ideen' : 'eigene Idee' !!}</div>
                        @if(Auth::user()->role->level > 90)
                        <div class="small">{{ \App\Idea::all()->count() }} {!! ( \App\Idea::all()->count() != 1  ) ? 'Ideen insgesamt' : 'Idee insgesamt' !!}</div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="/ideas/index">
                <div class="panel-footer">
                    <span class="pull-left">Alle zeigen</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @if(Auth::user()->role->level > 90)
    <div class="col-xs-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-list-ul fa-4x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="large">{{ Auth::user()->categories->count() }} {!! ( Auth::user()->categories->count() != 1 ) ? 'Kategorien' : 'Kategorie' !!}</div>
                    </div>
                </div>
            </div>
            <a href="/settings/categories/index">
                <div class="panel-footer">
                    <span class="pull-left">Alle zeigen</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-usd fa-4x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="large">{{ Auth::user()->programs->count() }} {!! ( Auth::user()->programs->count() != 1 ) ? 'Partnerprogramme' : 'Partnerprogramm' !!} </div>
                    </div>
                </div>
            </div>
            <a href="/settings/partnerprograms/index">
                <div class="panel-footer">
                    <span class="pull-left">Alle zeigen</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif

</div>
@endsection


@section('page.title')
Allgemeines Dashboard
@endsection