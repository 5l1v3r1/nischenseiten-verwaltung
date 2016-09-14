<tr class="user-{{$user->id}}">
    <td>{{$user->id}}</td>
    <td><a class="update-user-name" data-pk="{{$user->id}}">{{$user->name}}</a>@if(Auth::user()->role->level > 90) (<a href="/user/autologin/{{$user->id}}">auto. Login</a>) @endif</td>
    <td>{{$user->projects->count()}}</td>
    <td><a class="update-user-email" data-pk="{{$user->id}}">{{$user->email}}</a></td>
    <td><a class="update-user-role" data-value="{{$user->role_id}}" data-pk="{{$user->id}}">{{$user->role->full_name}}</a></td>
    <td><a class="update-user-note" data-pk="{{$user->id}}">{{$user->note}}</a></td>
    <td><a class="delete-user" data-pk="{{$user->id}}" href="#"><i class="fa fa-trash"></i></a></td>
</tr>