<div>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
  
    @if($add)
        @include('livewire.club.create')
    @endif
    @if($update)
        @include('livewire.club.update')
    @endif

    @if(!$add)
        <div class="d-flex justify-content-between">
            <h3 class="float-left">Clubs Table</h3>
            <button wire:click="add()" class="btn btn-primary btn-sm float-right">Add New</button>
        </div>
    @endif
  
    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($clubs) > 0)
                    @foreach ($clubs as $v)
                        <tr>
                            <td>
                                {{$v->club_name}}
                            </td>
                            <td>
                                {{$v->club_city}}
                            </td>
                            <td>
                                <button wire:click="edit({{$v->id}})" class="btn btn-primary btn-sm">Edit</button>
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