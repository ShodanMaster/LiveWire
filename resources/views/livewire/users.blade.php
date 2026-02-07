<div
{{-- wire:init="loadUsers" --}}
{{-- wire:poll.5s="loadUsers" --}}
>
    <div>
        <input type="text" name="search" class="form-control mb-2" placeholder="search" wire:model="search" wire:keyup="set('search', $event.target.value)">
    </div>
    <div
        class="table-responsive"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">Action</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td scope="col">{{ $loop->iteration}}</td>
                        <td scope="col">{{ $user->name }}</td>
                        <td scope="col">{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger"
                                    wire:click="delete({{$user->id}})"
                                    {{-- wire:confirm.prompt="Are you sure you want to delete this user?" --}}
                                >
                                Delete
                            </button>
                        </td>
                        <td>
                            @if($user->is_active)
                            <span class="badge text-bg-primary">Active</span>
                            @else
                            <span class="badge text-bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
<script>
    $wire.on("confirm", () =>{
        alert();
    });
</script>
</div>
