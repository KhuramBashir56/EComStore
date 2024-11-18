<?php

namespace App\Livewire\Panel\Products;

use App\Models\ActivityLog;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ContentAndDescription extends Component
{
    public $product, $content, $text_count;

    public function mount($product)
    {
        $product = Product::where('ref_id', $product)->select('id', 'ref_id', 'unit_id', 'content', 'status')->first();
        if ($product && $product->status !== 'deleted') {
            if ($product->unit_id === NULL) {
                $this->redirectRoute('admin.products.add_product.pricing_and_colors', ['product' => $product->ref_id], navigate: true);
            } else {
                $this->product = $product;
                $this->content = $product->content;
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record Not Found.');
            $this->redirectRoute('admin.products.list', navigate: true);
        }
    }

    public function saveProductDescription()
    {
        $this->validate([
            'content' => ['required', 'string'],
        ], [
            'content.required' => 'Description is required.',
        ]);
        $this->validate([
            'text_count' => ['required', 'string', 'min:150', 'max:5000'],
        ], [
            'text_count.required' => 'Description is required.',
            'text_count.min' => 'Description must be at least 150 characters.',
            'text_count.max' => 'Description must be at most 5000 characters.',
        ]);
        $allowedTags = '<p><strong><em><s><ol><li><ul><blockquote><h2><h3><h4><pre><table><caption><thead><tr><th><tbody><td><hr><a>';
        try {
            DB::transaction(function () use ($allowedTags) {
                $this->product->content = strip_tags($this->content, $allowedTags);
                $this->product->update();
                ActivityLog::activity($this->product->id, 'create', 'Product', 'Description');
                $this->redirectRoute('admin.products.add_product.gallery', ['product' => $this->product->ref_id], navigate: true);
            });
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.content-and-description');
    }
}
