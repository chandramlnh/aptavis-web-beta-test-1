 <div>
    <form>
        @foreach ($newMatch as $index => $match)
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Match {{ $index + 1 }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="club_home_id">Club Home:</label>
                            <select class="form-control @error('newMatch.{{ $index }}.club_home_id') is-invalid @enderror" wire:model="newMatch.{{ $index }}.club_home_id">
                                <option selected>- Select Club Home -</option>
                                @foreach ($clubs as $v)
                                    <tr>
                                        <td>
                                            {{$v->club_name}}
                                        </td>
                                        <td>
                                            {{$v->club_city}}
                                        </td>
                                    </tr>
                                    <option value="{{ $v->id }}">{{ $v->club_name . " (" . $v->club_city . ")" }}</option>
                                @endforeach
                            </select>
                            @error('newMatch.{{ $index }}.club_home_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="club_away_id">Club Away:</label>
                            <select class="form-control @error('newMatch.{{ $index }}.club_away_id') is-invalid @enderror" wire:model="newMatch.{{ $index }}.club_away_id">
                                <option selected>- Select Club Away -</option>
                                @foreach ($clubs as $v)
                                    <tr>
                                        <td>
                                            {{$v->club_name}}
                                        </td>
                                        <td>
                                            {{$v->club_city}}
                                        </td>
                                    </tr>
                                    <option value="{{ $v->id }}">{{ $v->club_name . " (" . $v->club_city . ")" }}</option>
                                @endforeach
                            </select>
                            @error('newMatch.{{ $index }}.club_away_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="club_home_score">Home Score:</label>
                            <input type="text" class="form-control @error('newMatch.{{ $index }}.club_home_score') is-invalid @enderror" placeholder="Enter Home Score" wire:model="newMatch.{{ $index }}.club_home_score">
                            @error('newMatch.{{ $index }}.club_home_score')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="club_away_score">Away Score:</label>
                            <input type="text" class="form-control @error('newMatch.{{ $index }}.club_away_score') is-invalid @enderror" placeholder="Enter Away Score" wire:model="newMatch.{{ $index }}.club_away_score">
                            @error('newMatch.{{ $index }}.club_away_score')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button wire:click="removeMatch({{ $index }})" class="btn btn-danger btn-block">Delete Match {{ $index + 1 }}</button>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="d-grid gap-2 col-12 mb-3">
                <button wire:click.prevent="addMatch()" class="btn btn-primary btn-block">Add List</button>
                <hr class="w-100">
                <button wire:click.prevent="storeMultiple()" class="btn btn-success btn-block">Save</button>
                <button wire:click.prevent="back()" class="btn btn-secondary btn-block">Back</button>
            </div>
        </div>
    </form>
</div>