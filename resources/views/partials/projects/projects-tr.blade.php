<tr class="project-{{$project->id}}">
    <td>{{$project->id}}</td>
    <td><a class="update-project-name" data-pk="{{$project->id}}">{{$project->name}}</a>@if(Auth::user()->role->level>90) (<a href="/project/choose/{{$project->id}}">Wählen</a>) @endif</td>
    <td>{{$project->owner->name}}</td>
    <td><a class="update-project-notes" data-pk="{{$project->id}}">{{$project->notes}}</a></td>
    <!--<td><a class="update-project-gaviewid" data-pk="{{$project->id}}">{{$project->ga_view_id}}</a></td>-->
    <td><a class="delete-project" data-pk="{{$project->id}}" href="#"><i class="fa fa-trash"></i></a></td>
</tr>