<tr class="projectcompetition-{{$competition->id}}">
    <td>
        {{$competition->id}}
    </td>

    <td>
        <a class="update-projectcompetition-url" data-pk="{{$competition->id}}" href="#">{{$competition->url}}</a>
    </td>

    <td>
        <a class="update-projectcompetition-power" data-value="{{$competition->power}}" data-pk="{{$competition->id}}" href="#">{{$competition->power}}</a>
    </td>

    <td>
        <a class="update-projectcompetition-note" data-pk="{{$competition->id}}" href="#">{{$competition->note}}</a>
    </td>

    <td>
        <a class="delete-projectcompetition" data-pk="{{$competition->id}}" href="#"><i class="fa fa-trash"></i></a>
    </td>
</tr>