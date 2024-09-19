<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Support\Str;
class GovernorateManage extends Component
{
    public $governorates, $name, $slug, $governorate_id;
    public $updateMode = false;
    public function render()
    {
        $this->governorates = Governorate::all(); // Fetch all governorates
        return view('livewire.admin.governorate-manage');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->governorate_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:governorates,slug,'

        ]);

        Governorate::create([
            'name' => $this->name,
            'slug' => $this->slug ? Str::slug($this->slug) : Str::slug($this->name),

        ]);

        session()->flash('message', 'Governorate created successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $governorate = Governorate::findOrFail($id);
        $this->governorate_id = $governorate->id;
        $this->name = $governorate->name;
        $this->slug = $governorate->slug;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:governorates,slug,' . $this->governorate_id,
           ]);

        $governorate = Governorate::find($this->governorate_id);
        $governorate->update([
            'name' => $this->name,
            'slug' => $this->slug ? Str::slug($this->slug) : Str::slug($this->name),
        ]);

        session()->flash('message', 'Governorate updated successfully.');

        $this->resetInputFields();
        $this->updateMode = false;
    }


    public $deleteId = null;

public function confirmDelete($id)
{
    $this->deleteId = $id;  // Set the governorate to be deleted
    $this->dispatch('openModal');  // Emit the event to open the modal
}

public function delete()
{
    Governorate::find($this->deleteId)->delete();
    session()->flash('message', 'Governorate deleted successfully.');
    $this->dispatch('closeModal');  // Emit event to close the modal
    $this->deleteId = null;  // Reset after deletion
}
//     public function delete($id)
//     {
//         Governorate::find($id)->delete();
//         session()->flash('message', 'Governorate deleted successfully.');
//     }
}
