<div>
    @session('success')
    <div class="alert alert-success">
        <p>{{ $value}}</p>
    </div>
    @endsession
    <form wire:submit.prevent="submit">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control" wire:model="name">
        @error("name")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="">price</label>
        <input type="text" name="price" class="form-control" wire:model="price">
        @error("price")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="">Detail</label>
        <textarea name="details" class="form-control" wire:model="details"></textarea>
        @error("details")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="">Image</label>
        <input type="file" class="form-control" name="image" wire:model="image">
        @if($image)
            <img src="{{$image->temporaryUrl()}}" alt="image" width="400px"><br>
        @endif
        @error("image")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
    <div
        class="table-responsive mt-2"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Image</th>
                    <th scope="col">Download</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $product->name}}</td>
                        <td><img src="{{ asset( 'storage/' . $product->file_path) }}" alt="{{ $product->file_path }}" width="400px"></td>
                        <td>
                            @if($product->file_path)
                                <button class="btn btn-success" wire:click="download('{{ $product->file_path }}')">Download</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
