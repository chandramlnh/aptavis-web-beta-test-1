<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group mb-3">
                <label for="club_name">Club Name:</label>
                <input type="text" class="form-control @error('club_name') is-invalid @enderror" id="club_name" placeholder="Enter Club Name" wire:model="club_name">
                @error('club_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="club_city">Club City:</label>
                <input type="text" class="form-control @error('club_city') is-invalid @enderror" id="club_city" placeholder="Enter Club City" wire:model="club_city">
                @error('club_city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
                <button wire:click.prevent="cancel()" class="btn btn-secondary btn-block">Cancel</button>
            </div>
        </form>
    </div>
</div>