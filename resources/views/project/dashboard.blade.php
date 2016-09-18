@extends('layouts.fullwidth')

@section('content')
<div class="row">    
    @if( Session::get('project.id') )

    @include('project.sidebar')

    <div id="project-contentwrapper" class="col-xs-10">
        <div class="row">
            <!-- -->
            <div class="col-xs-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-comment-o fa-4x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                                <div class="large">{{$notes}} {!! ( $notes != 1 ) ? 'Notizen' : 'Notiz' !!}</div>
                            </div>
                        </div>
                    </div>
                    <a href="/project/notes">
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
                                <i class="fa fa-align-left fa-4x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                                <div class="large">{{$contentideas}} {!! ( $contentideas != 1 ) ? 'Contentideen' : 'Contentidee' !!}</div>
                            </div>
                        </div>
                    </div>
                    <a href="/project/content">
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
                                <i class="fa fa-user-secret fa-4x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                                <div class="large">{{ $competitors }} {!! ( $competitors != 1 ) ? 'Konkurrenten' : 'Konkurrent' !!}</div>
                            </div>
                        </div>
                    </div>
                    <a href="/project/competition">
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
                                <i class="fa fa-sort-amount-desc fa-4x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                                <div class="large">{{$keywords}} {!! ( $keywords != 1 ) ? 'Keywords' : 'Keyword' !!}</div>
                            </div>
                        </div>
                    </div>
                    <a href="/project/keywords">
                        <div class="panel-footer">
                            <span class="pull-left">Alle zeigen</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- -->

        </div>
        @if( $api->value != '' )
        <div id="metrics-panel" class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>mertics.tools Sichtbarkeitsindex</span>
                        <span class="pull-right"><a id="update-project-si" data-url="{{ Session::get('project.name') }}" href=""><i class="fa fa-refresh"></i> Aktualisieren</a></span>
                    </div>
                    <div class="panel-body">
                        @if($metrics_si !== null)
                        <canvas id="myChart"></canvas>
                        @else
                        <div class="alert alert-warning">Es wurden keine SI Daten im Cache gefunden. Entweder es gibt zu deiner Domain keine Daten, der API Key ist irgendwie falsch, du hast keine freien Credits diesen Monat oder du hast einfach vergessen oben rechts die Daten zu holen! ;)</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif


    </div>

    @else
    <div class="col-lg-12">
        <div class="alert alert-danger"><i class="fa fa-warning"></i> Bevor du die Projektmanagement-Funktionen nutzen kannst, musst du oben rechts in der Navigation auswählen, welches Projekt du verwalten willst.</div>
    </div>

    @endif

    <div id="message" class="alert"></div>

</div>
@endsection

@section('js.files')
<script src="/js/plugins/Chart.bundle.min.js"></script>
<script src="/js/project/project.si.check.js"></script>
@endsection

@section('css.files')

@endsection

@section('js.inline.code') 

@if($metrics_si !== null)

<script>
$(document).ready(function () {

    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {

        type: 'line',
        data: {
            labels: [
                @foreach ($metrics_si as $label) 
                    "{{$label['date']}}"
                    @if (!$loop->last) , @endif
                @endforeach

            ],
            datasets: [{
                label: 'Sichtbarkeitindex (metrics.tools)',
                data: [
                    @foreach($metrics_si as $label)
                            "{{$label['sk']}}"
                        @if (!$loop->last) , @endif
                    @endforeach
                ]
            }]
        },
        option: {
            responsive: true
        }
    });

});
</script>

@endif
@endsection

@section('page.title')
Projektdashboard
@endsection