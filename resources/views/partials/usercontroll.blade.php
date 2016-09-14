
@if (Auth::guest())
<li><a href="{{ url('/login') }}">Login</a></li>
@else


@if(count(Auth::user()->projects)>0)
<li class="dropdown {{ Request::is('project/*') ? 'active project-active' : '' }}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        @if(Session::get('project.id')>0 )
        <i class="fa fa-list-ul"></i> {{ ViewHelper::cleanUrl( Session::get('project.name') ) }} <span class="caret"></span>
        @else
        <i class="fa fa-list-ul"></i> Projekt auswählen <span class="caret"></span>
        @endif
    </a>

    <ul id="projectname-holder" class="dropdown-menu" role="menu">
        @foreach( Auth::user()->projects as $project)
        <li class="current-project-{{$project->id}}"><a href="/project/choose/{{$project->id}}">{{ViewHelper::cleanUrl($project->name)}}</a></li>
        @endforeach
    </ul>
</li>
@endif

<li class="dropdown">
    <a href="#" class="dropdown-toggle {{ Request::is('settings/*') ? 'active' : '' }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i> Einstellungen <span class="caret"></span></a>
    <ul class="dropdown-menu">
        @if(Auth::user()->role->level > 90)
        <li class="{{ Request::is('settings/categories/index') ? 'active' : '' }}"><a href="/settings/categories/index">Kategorien</a></li>
        @endif

        @if(Auth::user()->role->level > 90)
        <li class="{{ Request::is('settings/partnerprograms/index') ? 'active' : '' }}"><a href="/settings/partnerprograms/index">Partnerprogramme</a></li>
        @endif

        <li class="{{ Request::is('settings/projects/index') ? 'active' : '' }}"><a href="/settings/projects/index">Projekte</a></li>

        @if(Auth::user()->role->level > 90)
        <li class="{{ Request::is('settings/apis/index') ? 'active' : '' }}"><a href="/settings/apis/index">API & Crawling</a></li>
        @endif

        @if(Auth::user()->role->level > 90)
        <li class="{{ Request::is('settings/users/index') ? 'active' : '' }}"><a href="/settings/users/index">Nutzer</a></li>
        @endif
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <i class="fa fa-user"></i> <span id="current-user-name">{{ Auth::user()->name }}</span> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        <li class="{{ Request::is('user/profile') ? 'active' : '' }}"><a href="/user/profile">Profileinstellungen</a></li>
        <li class="divider"></li>
        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
@endif