<div wire:init="loadCategories">
    @session('success')
    <div class="alert alert-success">
        <p>{{ $value}}</p>
    </div>
    @endsession
    <form wire:submit.prevent="submit">

        <label for="category">Category</label>
        <select name="category" id="category" wire:model="category" class="form-control">
            <option value="">select category</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        <label for="">Name</label>
        <input type="text" name="name" class="form-control"
        wire:model="name"
        {{-- wire:dirty.class="is-invalid"
        wire:dirty.class.remove="is-valid" --}}
        {{-- wire:model.live="name" --}}
        >
        <p>{{$name}}</p>
        @error("name")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="">price</label>
        <input type="number" name="price" class="form-control"
        wire:model="price"
        {{-- wire:dirty.class="is-invalid"
        wire:dirty.class.remove="is-valid" --}}
        {{-- wire:model.blur="price" --}}
        >
        <p>{{$price}}</p>
        @error("price")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="">Detail</label>
        <textarea name="details" class="form-control"
        wire:model="details"
        {{-- wire:dirty.class="is-invalid"
        wire:dirty.class.remove="is-valid" --}}
        ></textarea>
        @error("details")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="isFeatured">
            <input type="checkbox" id="isFeatured" name="isFeatured" wire:model.live="isFeatured">
            Is Featured
        </label><br>

        @if($isFeatured)
            <div class="mt-3" wire:transition.origin.top>
                <label for="">featured Reason</label>
                <textarea name="featuredReason" class="form-control"
                wire:model="featuredReason"
                {{-- wire:dirty.class="is-invalid"
                wire:dirty.class.remove="is-valid" --}}
                ></textarea>
            </div>
        @endif

        <label for="">Image</label>
        <input type="file" class="form-control" name="image" wire:model="image">
        @if($image)
            <img src="{{$image->temporaryUrl()}}" alt="image" width="400px"><br>
        @endif
        @error("image")
        <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="publich_date">Publish Date</label>
        <input type="text" name="publish_date" id="publich_date" class="form-control"
        wire:model="publish_date">

        <div class="mt-3">
            <button type="submit" class="btn btn-success" wire:loading.attribute="disable">Submit</button>
            <button type="button" class="btn btn-secondary" wire:click="resetForm">reset</button>
            <button
                type="button"
                class="btn btn-secondary"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Tooltip on top">
                Tooltip on top
            </button>

            {{-- <p wire:loading>Products Loadings...</p> --}}
        </div>
        {{-- <div wire:dirty>Unsaved changes...</div> --}}
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
                    <th scope="col">Publish Date</th>
                    <th scope="col">Download</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $product->name}}</td>
                        <td><img src="{{ asset( 'storage/' . $product->file_path) }}" alt="{{ $product->file_path }}" width="400px"></td>
                        <td>{{ $product->publish_date ?? '-'}}</td>
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

    @script
    <script>
        $('#publich_date').datepicker({
            format: 'mm/dd/yyyy',
        }).on("changeDate", function(e){
            @this.set("publish_date", e.format('yyyy-mm-dd'));
        });
    </script>
    @endscript
</div>
