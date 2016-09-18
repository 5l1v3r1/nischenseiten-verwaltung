<tr class="projectnote-{{$note->id}}">
    <td>
        {{$note->created_at->format('j.n.Y')}}
    </td>

    <td>
        <a class="update-projectnote-name" data-pk="{{$note->id}}" href="#">{{$note->name}}</a>
    </td>

    <td>
        <a class="update-projectnote-content" data-pk="{{$note->id}}" href="#">{{$note->note}}</a>
    </td>

    <td class="star-rated-value">
        <a class="update-projectnote-priority" data-value="{{$note->priority}}" data-pk="{{$note->id}}" href="#">{{$note->priority}}</a>
    </td>

    <td>
        <a class="update-projectnote-deadline" data-value="{{$note->deadline}}" data-pk="{{$note->id}}" href="#">{{$note->deadline}}</a> @if(ViewHelper::deadlineWarning($note->deadline) < 2 ) <i class=" red fa fa-warning"></i> @endif
    </td>
    
    <td>
        @if(is_null( $note->deleted_at) )
        <a ata-toggle="tooltip" data-title="Archivieren" class="archive-projectnote" data-pk="{{$note->id}}" href="#"><i class="fa fa-archive"></i></a>
        @else
        <small>Archiviert am<br />{{$note->deleted_at->format('j.n.Y')}}</small>
        @endif
    </td>

    <td>
        <a data-toggle="tooltip" data-title="Löschen" class="delete-projectnote" data-pk="{{$note->id}}" href="#"><i class="fa fa-trash"></i></a>
    </td>
</tr>