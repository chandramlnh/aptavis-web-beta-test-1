 <div>
    <form>
        <div class="row">
            <div class="form-group mb-3 col-6">
                <label for="club_home_id">Club Home:</label>
                <select class="form-control @error('club_home_id') is-invalid @enderror" wire:model="club_home_id">
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
                @error('club_home_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="club_away_id">Club Away:</label>
                <select class="form-control @error('club_away_id') is-invalid @enderror" wire:model="club_away_id">
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
                @error('club_away_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="club_home_score">Home Score:</label>
                <input type="text" class="form-control @error('club_home_score') is-invalid @enderror" id="club_home_score" placeholder="Enter Home Score" wire:model="club_home_score">
                @error('club_home_score')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="club_away_score">Away Score:</label>
                <input type="text" class="form-control @error('club_away_score') is-invalid @enderror" id="club_away_score" placeholder="Enter Away Score" wire:model="club_away_score">
                @error('club_away_score')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-grid gap-2 col-12">
                <button wire:click.prevent="storeSingle()" class="btn btn-success btn-block">Save</button>
                <button wire:click.prevent="back()" class="btn btn-secondary btn-block">Back</button>
            </div>
        </div>
    </form>
</div>