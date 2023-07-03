@if($addSingle)
    @include('livewire.input-score.create-single')
@endif

@if($add)
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

