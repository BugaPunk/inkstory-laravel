<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use App\Models\Editorial;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditorialIndex extends Component
{
    use WithFileUploads;

    public $showingEdModal = false;

    public $name;
    public $newImage;
    public $oldImage;
    public $isEditMode = false;
    public $editorial;

    public function showEdModal()
    {
        $this->reset();
        $this->showingEdModal = true;
    }

    public function storeEd()
    {
        $this->validate([
            'newImage' => 'image|max:2048', // 1MB Max
            'name' => 'required'
        ]);
        $image = $this->newImage->store('public/images');

        Editorial::create([
            'name' => $this->name,
            'image' => $image,
        ]);

        $this->reset();
    }

    public function showEditEdModal($id)
    {
        $this->editorial = Editorial::findOrFail($id);
        $this->name = $this->editorial->name;
        $this->oldImage = $this->editorial->image;
        $this->isEditMode = true;
        $this->showingEdModal = true;
    }

    public function updateEd()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $image = $this->editorial->image;
        if ($this->newImage) {
            $image = $this->newImage->store('public/images');
        }

        $this->editorial->update([
            'name' => $this->name,
            'image' => $image
        ]);
        $this->reset();
    }

    public function deleteEd($id)
    {
        $editorial = Editorial::findOrFail($id);
        Storage::delete($editorial->image);
        $editorial->delete();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.editorial-index', [
            'editorials' => Editorial::all()
        ]);
    }
}
