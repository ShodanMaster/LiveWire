<div>
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
</div>
