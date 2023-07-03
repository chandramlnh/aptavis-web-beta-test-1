<div>
    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th class="text-center" style="width:1px;">No</th>
                    <th class="text-left">Club</th>
                    <th class="text-center" style="width:1px;">M</th>
                    <th class="text-center" style="width:1px;">W</th>
                    <th class="text-center" style="width:1px;">D</th>
                    <th class="text-center" style="width:1px;">L</th>
                    <th class="text-center" style="width:1px;">GW</th>
                    <th class="text-center" style="width:1px;">GL</th>
                    <th class="text-center" style="width:1px;">Point</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @if (count($clubs) > 0)
                    @foreach ($clubs as $v)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $v->club_name }}</td>
                            <td class="text-center">{{ $v->tMatch ?: "0" }}</td>
                            <td class="text-center">{{ $v->win ?: "0" }}</td>
                            <td class="text-center">{{ $v->draw ?: "0" }}</td>
                            <td class="text-center">{{ $v->lose ?: "0" }}</td>
                            <td class="text-center">{{ $v->goal_win ?: "0" }}</td>
                            <td class="text-center">{{ $v->goal_lose ?: "0" }}</td>
                            <td class="text-center">{{ $v->point ?: "0" }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" align="center">
                            No Matches Yet.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
