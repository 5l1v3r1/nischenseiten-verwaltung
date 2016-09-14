<tr class="partnerprogram-{{$pp->id}}">
    <td>{{$pp->id}}</td>
    <td><a class="update-partnerprogram-name" data-pk="{{$pp->id}}">{{$pp->name}}</a></td>
    <td>{{$pp->ideaCount->count()}}</td>
    <td><a class="update-partnerprogram-notes" data-pk="{{$pp->id}}">{{$pp->notes}}</a></td>
    <td>{{$pp->owner->name}}</td>
    <td><a class="delete-partnerprogram" data-pk="{{$pp->id}}" href="#"><i class="fa fa-trash"></i></a></td>
</tr>