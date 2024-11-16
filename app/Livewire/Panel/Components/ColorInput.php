<?php

namespace App\Livewire\Panel\Components;

use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductColorImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ColorInput extends Component
{
    use WithFileUploads;

    public $product, $name, $image;

    public $primaryCode = '#ff0000';
    public $primaryColor = '#ff0000';

    public $secondaryCode = '#3189af';
    public $secondaryColor = '#3189af';

    public $type = 'singleColor';

    public $singleColor = true;

    public $combinationColor = false;

    public $colorImage = false;

    public $colorImages = [];

    public function mount($product)
    {
        $product = Product::where('status', '!=', 'deleted')->where('ref_id', $product)->select('id', 'ref_id', 'status')->first();
        if ($product && $product->status !== 'deleted') {
            $this->product = $product;
        } else {
            $this->redirectRoute('admin.products.list', navigate: true);
            $this->dispatch('alert', type: 'warning', message: 'Record Not Found.');
        }
    }

    public function updatedType()
    {
        if ($this->type === 'singleColor') {
            $this->singleColor = true;
            $this->combinationColor = false;
            $this->colorImage = false;
        } elseif ($this->type === 'combinationColor') {
            $this->singleColor = false;
            $this->combinationColor = true;
            $this->colorImage = false;
        } elseif ($this->type === 'colorImage') {
            $this->singleColor = false;
            $this->combinationColor = false;
            $this->colorImage = true;
        } else {
            $this->type = 'singleColor';
            $this->singleColor = true;
            $this->combinationColor = false;
            $this->colorImage = false;
        }
        $this->reset(['name', 'primaryColor', 'primaryCode', 'secondaryColor', 'secondaryCode', 'image']);
    }

    public function updatedPrimaryColor()
    {
        $this->primaryCode = $this->primaryColor;
    }

    public function updatedPrimaryCode()
    {
        $this->primaryColor = $this->primaryCode;
    }

    public function updatedSecondaryColor()
    {
        $this->secondaryCode = $this->secondaryColor;
    }

    public function updatedSecondaryCode()
    {
        $this->secondaryColor = $this->secondaryCode;
    }

    public function saveSingleColor()
    {
        $this->validate([
            'name' => ['required', 'alpha_dash', 'max:48'],
            'primaryCode' => ['required', 'hex_color', 'max:7'],
            'primaryColor' => ['required', 'hex_color', 'max:7']
        ]);
        if ($this->product->colors->count() + $this->product->colorImages->count()  < 12) {
            $exist_color = $this->product->colors->where('primary', $this->primaryCode)->where('secondary', NULL)->first();
            if (empty($exist_color)) {
                try {
                    DB::transaction(function () {
                        $color = new ProductColor;
                        $color->product_id = $this->product->id;
                        $color->name = $this->name;
                        $color->primary = $this->primaryCode;
                        $color->secondary = NULL;
                        $color->save();
                        ActivityLog::activity($this->product->id, 'create', 'Product', 'Added new product color ID ' . $color->id);
                    });
                    $this->reset(['name', 'primaryColor', 'primaryCode', 'secondaryColor', 'secondaryCode', 'image']);
                    $this->dispatch('alert', type: 'success', message: 'Product color saved successfully');
                } catch (\Throwable $th) {
                    $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                }
            } else {
                $this->dispatch('alert', type: 'warning', message: 'Color already exist');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'You can not add more than 12 colors');
        }
    }

    public function saveCombinationColor()
    {
        $this->validate([
            'name' => ['required', 'alpha_dash', 'max:48'],
            'primaryCode' => ['required', 'hex_color', 'max:7'],
            'primaryColor' => ['required', 'hex_color', 'max:7'],
            'secondaryCode' => ['required', 'hex_color', 'max:7'],
            'secondaryColor' => ['required', 'hex_color', 'max:7']
        ]);
        if ($this->product->colors->count() + $this->product->colorImages->count()  < 12) {
            $exist_color = $this->product->colors->where('primary', $this->primaryCode)->where('secondary', $this->secondaryCode)->first();
            if (empty($exist_color)) {
                try {
                    DB::transaction(function () {
                        $color = new ProductColor;
                        $color->product_id = $this->product->id;
                        $color->name = $this->name;
                        $color->primary = $this->primaryCode;
                        $color->secondary = $this->secondaryCode;
                        $color->save();
                        ActivityLog::activity($this->product->id, 'create', 'Product', 'Added new product color ID ' . $color->id);
                    });
                    $this->reset(['name', 'primaryColor', 'primaryCode', 'secondaryColor', 'secondaryCode', 'image']);
                    $this->dispatch('alert', type: 'success', message: 'Product color saved successfully');
                } catch (\Throwable $th) {
                    $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                }
            } else {
                $this->dispatch('alert', type: 'warning', message: 'Color already exist');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'You can not add more than 12 colors');
        }
    }

    public function removeColor(ProductColor $color)
    {
        if ($this->product->status !== 'deleted') {
            try {
                DB::transaction(function () use ($color) {
                    $color->delete();
                    ActivityLog::activity($this->product->id, 'delete', 'Product', 'Removed product color ID ' . $color->id);
                });
                $this->dispatch('alert', type: 'success', message: 'Product colors removed successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function saveColorImage()
    {
        $this->validate([
            'name' => ['required', 'alpha_dash', 'max:48'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:100']
        ]);
        if ($this->product->colors->count() + $this->product->colorImages->count()  < 12) {
            try {
                DB::transaction(function () {
                    $color = new ProductColorImage;
                    $color->product_id = $this->product->id;
                    $color->name = $this->name;
                    $color->path = $this->image->store('products/color_images', 'public');
                    $color->save();
                    ActivityLog::activity($this->product->id, 'create', 'Product', 'Added new product color image ID ' . $color->id);
                });
                $this->reset(['name', 'primaryColor', 'primaryCode', 'secondaryColor', 'secondaryCode', 'image']);
                $this->dispatch('alert', type: 'success', message: 'Product color saved successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'You can not add more than 12 colors');
        }
    }

    public function removeColorImage(ProductColorImage $color)
    {
        if ($this->product->status !== 'deleted') {
            try {
                DB::transaction(function () use ($color) {
                    $color->delete();
                    ActivityLog::activity($this->product->id, 'delete', 'Product', 'Removed product color image ID ' . $color->id);
                });
                Storage::disk('public')->delete($color->path);
                $this->dispatch('alert', type: 'success', message: 'Product color image removed successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function render()
    {
        return view('livewire.panel.components.color-input', [
            'colors' => $this->product->colors()->select('id', 'product_id', 'name', 'primary', 'secondary')->get(),
            'imageColors' => $this->product->colorImages()->select('id', 'product_id', 'name', 'path')->get(),
        ]);
    }
}
