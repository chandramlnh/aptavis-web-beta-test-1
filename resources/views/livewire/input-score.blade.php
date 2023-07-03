<div>
    @if($addSingle)
        @include('livewire.input-score.create-single')
    @endif

    @if($addMultiple)
        @include('livewire.input-score.create-multiple')
    @endif

    @if($add && !$addSingle && !$addMultiple)
    <div>
        <div class="d-flex">
            <button wire:click="addSingle()" class="btn btn-primary w-100 mr-1">Single Match</button>
            <button wire:click="addMultiple()" class="btn btn-primary w-100 ml-1">Multiple Match</button>
        </div>
        <button wire:click="cancel()" class="btn btn-secondary btn-block mt-2">Cancel</button>
    </div>
    @endif

    @if(!$add)
        <div>
            <button wire:click="add()" class="btn btn-primary btn-block">Add New</button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th class="text-center">Home</th>
                    <th class="text-center">Away</th>
                    <th class="text-center" style="width: 1px">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($matches) > 0)
                    @foreach ($matches as $v)
                        <tr>
                            <td class="text-center">
                                {{$v->club_home_name . " " . "(" . $v->club_home_score . ")"}}
                            </td>
                            <td class="text-center">
                                {{$v->club_away_name . " " . "(" . $v->club_away_score . ")"}}
                            </td>
                            <td class="text-center">
                                <button wire:click="delete({{$v->id}})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" align="center">
                            No Clubs Found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>