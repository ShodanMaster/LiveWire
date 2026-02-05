

<div>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td scope="col">{{ $loop->iteration}}</td>
                        <td scope="col">{{ $user->name }}</td>
                        <td scope="col">{{ $user->email }}</td>
                        <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

</div>
