@if(!empty($games))

    @foreach($games as $k => $g)
        <tr>
            <td class="text-center">{{ $g['gameid'] }}</td>
            <td><strong>{{ $g['name'] }}</strong></td>
            <td><img width="200" src="{{ $g['logo'] }}" alt="{{ $g['name'] }}"></td>
            <td><span>{{ $g['email'] }}</span></td>
            <td class="text-center"><span class="label label-info">{{ $g['status'] }}</span></td>
            <td class="text-center">
                <a href="javascript:void(0)" onclick="game.detail({{ $g['gameid'] }})" data-toggle="tooltip"
                   title="Detail" class="btn btn-effect-ripple btn-xs btn-info"><i class="fa fa-eye fa-fw"></i></a>
                {{-- <a href="javascript:void(0)" onclick="game.edit({{ $g->game_id }})" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a> --}}
                <a href="{{ route('cms.g.game.editGame', $g['gameid']) }}" data-toggle="tooltip" title="Edit"
                   class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" onclick="game.del({{ $g['gameid'] }})" data-toggle="tooltip" title="Delete"
                   class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-times"></i></a>
            </td>
        </tr>
    @endforeach

@endif
