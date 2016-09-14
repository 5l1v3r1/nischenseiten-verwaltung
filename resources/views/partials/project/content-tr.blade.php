<tr class="projectcontent-{{$content->id}}">
    <td>
        {{$content->id}}
    </td>

    <td>
        <a class="update-projectcontent-name" data-pk="{{$content->id}}" href="#">{{$content->name}}</a>
    </td>

    <td>
        <a class="update-projectcontent-keyword" data-pk="{{$content->id}}" href="#">{{$content->keyword}}</a>
    </td>

    <td>
        <a class="update-projectcontent-note" data-pk="{{$content->id}}" href="#">{{$content->note}}</a>
    </td>

    <td>
        <a class="update-projectcontent-priority" data-value="{{$content->priority}}" data-pk="{{$content->id}}" href="#">{{$content->priority}}</a>
    </td>

    <td>
        @if(is_null( $content->deleted_at) )
        <a data-toggle="tooltip" data-title="Archivieren" class="archive-projectcontent" data-pk="{{$content->id}}" href="#"><i class="fa fa-archive"></i></a>
        @else
        <small>Archiviert am<br />{{$content->deleted_at->format('j.n.Y')}}</small>
        @endif
    </td>

    <td>
        <a data-toggle="tooltip" data-title="Löschen" class="delete-projectcontent" data-pk="{{$content->id}}" href="#"><i class="fa fa-trash"></i></a>
    </td>
</tr>