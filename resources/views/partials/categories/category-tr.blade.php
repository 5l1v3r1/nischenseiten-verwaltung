<tr class="category-{{$cat->id}}">
    <td>{{$cat->id}}</td>
    <td><a class="update-category-name" data-pk="{{$cat->id}}">{{$cat->name}}</a></td>
    <td>{{$cat->ideaCount->count()}}</td>
    <td><a class="update-category-notes" data-pk="{{$cat->id}}">{{$cat->notes}}</a></td>
    <td>{{$cat->owner->name}}</td>
    <td><a class="delete-category" data-pk="{{$cat->id}}" href="#"><i class="fa fa-trash"></i></a></td>
</tr>