<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $name, $type, $icon;

    protected $rules = [
        'name' => 'required|string|max:255',
        'type' => 'required|in:INCOME,EXPENSE',
        'icon' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
    ];

    public function save()
    {
        $user = Auth::user();
        $this->validate();

        $iconPath = null;
        if ($this->icon) {
            $slug = Str::slug($this->name);
            $extension = $this->icon->getClientOriginalExtension();
            $filename = "{$slug}-icon.{$extension}";
            $iconPath = $this->icon->storeAs('icons/category', $filename, 'public');
        }

        Category::create([
            'family_id' => $user->family_id,
            'name' => $this->name,
            'type' => strtoupper($this->type),
            'icon' => $iconPath,
        ]);

        $this->dispatch('categoryCreated');
        $this->reset(['name', 'type', 'icon']);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.category.create-category');
    }
}
