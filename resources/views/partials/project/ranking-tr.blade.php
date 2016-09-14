<tr>

    <td>
        {{$key+1}}
    </td>

    <td>
        {{$keyword['keyword']}}
    </td>

    <td>
        {{$keyword['position']}}
    </td>

    <td>
        @if($keyword['position_diff'] > 0) <span class="goes-up"><i class="fa fa-arrow-up"></i> +{{ $keyword['position_diff'] }} </span> @elseif($keyword['position_diff']<0) <span class="goes-down"><i class="fa fa-arrow-down"></i> {{$keyword['position_diff']}}</span> @else {{$keyword['position_diff']}}  @endif
    </td>

    <td>
        {{$keyword['searchvolume']}}
    </td>

    <td>
        {{$keyword['cpc']}}
    </td>

    <td>
        {{$keyword['competition']}}
    </td>

    <td>
        <a target="_blank" href="{{$keyword['url']}}">{{$keyword['url']}}</a>
    </td>

    <td>
        {{$keyword['date']}}
    </td>
</tr>