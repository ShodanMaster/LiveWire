<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Laravel\Prompts\info;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name, $price, $details, $image;

    public function render()
    {
        return view('livewire.product-create', [
            'products' => Product::all(),
        ]);
    }

    public function submit(){
        $this->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric|min:5',
            'details' => 'required',
            'image' => 'nullable|image',
        ]);

        $path = null;

        if ($this->image) {
            // stored in storage/app/public/images
            $path = $this->image->store('images', 'public');
        }

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'details' => $this->details,
            'file_path' => $path,
        ]);

        $this->reset(['name', 'price', 'details', 'image']);

        // session()->flash('success', 'Form Submiited Successfully');

        return redirect()->route('success');
    }

    public function download($filePath)
    {
        return Storage::disk('public')->download($filePath);
    }

}
