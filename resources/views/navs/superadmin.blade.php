<li class="{{ Request::is('dashboard') ? 'active' : '' }}">
    <a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a>
</li>

@if( Session::get('project.id') )
<li id="current-active-project-{{Session::get('project.id')}}" class="{{ Request::is('project/*') ? 'active' : '' }}">
    <a href="/project/dashboard"><i class="fa fa-diamond"></i> Projektmanagement</a>
</li>
@endif

<li class="{{ Request::is('ideas/index') ? 'active' : '' }}">
    <a href="/ideas/index"><i class="fa fa-lightbulb-o"></i> Ideen</a>
</li>

