<tr class="projectkeyword-{{$keyword->id}}">
    <td>
        {{$keyword->id}}
    </td>

    <td>
        <a class="update-projectkeyword-name" data-pk="{{$keyword->id}}" href="#">{{$keyword->name}}</a>
    </td>

    <td>
        <a class="update-projectkeyword-done" data-value="{{$keyword->has_content}}" data-pk="{{$keyword->id}}" href="#">{{$keyword->has_content}}</a>
    </td>

    <td>
        <a class="update-projectkeyword-sv" data-pk="{{$keyword->id}}" href="#">{{$keyword->searchvolume}}</a>
    </td>

    <td>
        <a class="update-projectkeyword-cpc" data-pk="{{$keyword->id}}" href="#">{{$keyword->cpc}}</a>
    </td>

    <td>
        <a class="update-projectkeyword-comp" data-pk="{{$keyword->id}}" href="#">{{$keyword->competition}}</a>
    </td>

    <td>
        <a class="update-projectkeyword-note" data-pk="{{$keyword->id}}" href="#">{{$keyword->note}}</a>
    </td>
    @if( $api->value != '' )
    <td>
        <a class="refresh-projectkeyword" data-pk="{{$keyword->id}}" href="#"><i class="fa fa-refresh"></i></a>
    </td>
    @endif
    
    <td>
        <a class="delete-projectkeyword" data-pk="{{$keyword->id}}" href="#"><i class="fa fa-trash"></i></a>
    </td>
</tr>