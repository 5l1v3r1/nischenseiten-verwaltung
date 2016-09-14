<tr class="idea-{{$idea->id}}">
    <td>{{$idea->id}}</td>
    <td><a class="update-idea-topic" data-pk="{{$idea->id}}">{{$idea->name}}</a></td>
    <td><a class="update-idea-category" data-value="{{$idea->category_id}}" data-pk="{{$idea->id}}">{{$idea->category_name}}</a></td>
    <td><a class="update-idea-sv" data-pk="{{$idea->id}}">{{$idea->searchvolume}}</a></td>
    <td><a class="update-idea-cpc" data-pk="{{$idea->id}}">{{$idea->cpc}}</a></td>
    <td><a class="update-idea-ppp" data-pk="{{$idea->id}}">{{$idea->price_per_product}}</a></td>
    <td><a class="update-idea-bc" data-pk="{{$idea->id}}">{{$idea->buy_conversion}}</a></td>
    <td>
        <span class="update-idea-potential">
            CPC: <span class="cpc-potential">{{ round($idea->searchvolume*($idea->buy_conversion/100)*$idea->cpc,2) }}</span> €<br />
            PPP: <span class="ppp-potential">{{ round($idea->searchvolume*($idea->buy_conversion/100)*$idea->price_per_product*($idea->provision/100),2) }}</span> €
        </span>
    </td>
    <td><a class="update-idea-partnerprogram" data-value="{{$idea->partner_id}}" data-pk="{{$idea->id}}">{{$idea->partner_name}}</a></td>
    <td><a class="update-idea-provision" data-pk="{{$idea->id}}">{{$idea->provision}}</a></td>
    <td><a class="update-idea-seasonal" data-value="{{$idea->seasonal}}" data-pk="{{$idea->id}}">@if($idea->seasonal==1) Ja @else Nein @endif</a></td>
    <td><a class="update-idea-keywords" data-pk="{{$idea->id}}">{{$idea->keywords}}</a></td>
    <td><a class="update-idea-domains" data-pk="{{$idea->id}}">{{ $idea->domains }}</a></td>
    <td><a class="update-idea-competitionpower" data-value="{{$idea->competition_power}}" data-pk="{{$idea->id}}">{{$idea->competition_power}}</a></td>
    <td><a class="update-idea-ranking" data-value="{{ $idea->ranking }}" data-pk="{{$idea->id}}">{{ $idea->ranking }}</a></td>
    <td><a class="idea-notes" href="/ideas/notes/{{$idea->id}}"><i class="fa fa-comment-o"></i></a></td>
    @if( $api->value != '' )
    <td><a class="refresh-ideakeyword" data-pk="{{$idea->id}}" href="#"><i class="fa fa-refresh"></i></a></td>
    @endif
    <td><a class="delete-idea" data-pk="{{$idea->id}}" href="#"><i class="fa fa-trash"></i></a></td>
</tr>