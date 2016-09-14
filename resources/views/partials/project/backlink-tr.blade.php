<tr class="backlink-{{$backlink->id}}">
    <td>
        {{$backlink->id}}
    </td>

    <td>
        @if($backlink->linksource!='') <a target="_blank" rel="noreferrer" href="{{$backlink->linksource}}"><i class="fa fa-link"></i></a>@endif <a class="update-backlink-source" data-pk="{{$backlink->id}}" href="#">{{$backlink->linksource}}</a>
    </td>

    <td>
        <a class="update-backlink-target" data-pk="{{$backlink->id}}" href="#">{{$backlink->linktarget}}</a>
    </td>

    <td>
        <a class="update-backlink-text" data-pk="{{$backlink->id}}" href="#">{{$backlink->linktext}}</a>
    </td>

    <td>
        <a class="update-backlink-relation" data-value="{{$backlink->relation}}" data-pk="{{$backlink->id}}" href="#">{{$backlink->relation}}</a>
    </td>

    <td>
        Status: <span class="status">@if($backlink->status==200) <span class="green"> @else <span class="red"> @endif {{$backlink->status}}</span></span><br />
        Gefunden: <span class="found">@if( $backlink->found == 1) <span class="green">Ja @else <span class="red">Nein @endif</span></span>
    </td>

    <td>
        <a class="update-backlink-note" data-pk="{{$backlink->id}}" href="#">{{$backlink->note}}</a>
    </td>

    <td>
        {{ date('j.n.Y', strtotime($backlink->checked_at)) }}
    </td>
    
    <td>
        <a class="refresh-link" data-pk="{{$backlink->id}}" href="#"><i class="fa fa-refresh"></i></a>
    </td>
    
    <td>
        <a class="delete-backlink" data-pk="{{$backlink->id}}" href="#"><i class="fa fa-trash"></i></a>
    </td>
</tr>