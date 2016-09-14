<div class="col-xs-2">
    <div id="sidenav">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-bars"></i> Projektnavigation</div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">

                    <li class="{{ Request::is('project/dashboard') ? 'active' : '' }}"><a href="/project/dashboard"><i class="fa fa-dashboard"></i> Projektdashboard</a></li>
                    <li class="{{ Request::is('project/notes') ? 'active' : '' }}"><a href="/project/notes"><i class="fa fa-comment-o"></i> Notizen</a></li>
                    <li class="{{ Request::is('project/content') ? 'active' : '' }}"><a href="/project/content"><i class="fa fa-align-left"></i> Contentplanung</a></li>
                    <li class="{{ Request::is('project/competition') ? 'active' : '' }}"><a href="/project/competition"><i class="fa fa-user-secret"></i> Konkurrenz</a></li>
                    <li class="{{ Request::is('project/keywords') ? 'active' : '' }}"><a href="/project/keywords"><i class="fa fa-sort-amount-desc"></i> Keywords</a></li>
                    <li class="{{ Request::is('project/backlinks') ? 'active' : '' }}"><a href="/project/backlinks"><i class="fa fa-link"></i> Backlinks</a></li>
                    @if( $api->value != '' )
                    <li class="{{ Request::is('project/rankings') ? 'active' : '' }}"><a href="/project/rankings"><i class="fa fa-sort-numeric-asc"></i> Rankings</a></li>
                    @endif
                </ul>
            </div>
        </div>

    </div>

    @if( $api->value == '' )
    <div id="metricsad">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-warning"></i> Erweiterte Funktionen</div>
            <div class="panel-body">
                Falls du einen Account bei <a target="_blank" href="https://metrics.tools/x/hufe">metrics.tools</a> hast, kannst du diesen in den Einstellungen eintragen und dadurch erweiterte Funktionen aktivieren (Rankings, Sichtbarkeit, auto. Holen von SV und CPC zu jedem Keyword,...).
            </div>
        </div>
    </div>
    @endif

    <div id="me">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-question-circle"></i> Feedback oder Probleme?</div>
            <div class="panel-body">
                Falls du Feedback, Fragen oder Probleme hast, kannst du mir gerne schreiben - hierzu einfach mal in <a target="_blank" href="https://www.damianschwyrz.de/">meinem Blog vorbeischauen</a>. 
            </div>
        </div>
    </div>
</div>

