<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Laravel\Prompts\info;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name, $price, $details, $image, $isFeatured, $featuredReason, $category;
    public $categories = [], $products = [];

    public function mount(){
        $this->products = Product::latest()->get();
    }

    public function render()
    {
        return view('livewire.product-create');
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

        $this->products = Product::latest()->get();

        $this->reset(['name', 'price', 'details', 'image', 'category', 'isFeatured']);

        // session()->flash('success', 'Form Submiited Successfully');
        sleep(3);

        // return redirect()->route('success');
    }

    public function download($filePath)
    {
        return Storage::disk('public')->download($filePath);
    }

    public function resetForm(){
        $this->reset(['name', 'price', 'details', 'image', 'category', 'isFeatured']);
    }

    public function loadCategories(){
        $this->categories = Category::all();
    }
}
