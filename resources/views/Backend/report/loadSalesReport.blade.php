@foreach ($cart as $i=>$ct)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>
            @foreach ($user as $usr)
                @if ($usr->id == $ct->user_id)
                    {{ $usr->name }}
                @endif
            @endforeach
        </td>

        <td>
            @foreach ($pkg as $pk)
                @if ($pk->id == $ct->package_id)
                    @foreach ($user as $usr)
                        @if ($pk->userid == $usr->id)
                            {{ $usr->name }}
                        @endif
                    @endforeach
                @endif
            @endforeach
        </td>

        <td>
            @foreach ($user as $usr)
                @if ($usr->id == $ct->agent_id)
                    {{ $usr->name }}
                @endif
            @endforeach
        </td>

        <td>
            @foreach ($pkg as $pk)
                @if ($pk->id == $ct->package_id)
                    {{ $pk->package_title }}
                @endif
            @endforeach
        </td>

        <td>
            {{ $ct->down_payemnt }}
        </td>

        <td>
            {{ $ct->comission }}
        </td>

        <td>
            {{ $ct->price }}
        </td>

        <td>
            {{ $ct->deal_date }}
        </td>

    </tr>
@endforeach
