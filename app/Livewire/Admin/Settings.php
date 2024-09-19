<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class Settings extends Component
{
    use WithFileUploads;

    public $title;
    public $website_name;
    public $description;
    public $logo;
    public $favicon;
    public $maintenance_mode;
    public $phone;
    public $facebook;
    public $twitter;
    public $current_logo, $current_favicon;
    public function mount()
    {
        // Load current settings from the database (assuming you have a Setting model)
        $settings = Setting::first(); // or where('key', 'value')
        if (!$settings) {
            $settings = Setting::create([
                'title' => 'Default Title',
                'website_name' => 'Default Title',
                'description' => 'Default description',
                'maintenance_mode' => false,
                'phone' => '+1234567890',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
            ]);
        }
        if ($settings) {
            $this->title = $settings->title;
            $this->website_name = $settings->website_name;
            $this->description = $settings->description;
            $this->maintenance_mode = $settings->maintenance_mode;
            $this->phone = $settings->phone;
            $this->facebook = $settings->facebook;
            $this->twitter = $settings->twitter;
            $this->current_logo = $settings->logo;
            $this->current_favicon = $settings->favicon;
        }
    }

    public function saveSettings()
    {
        // Validation
        $this->validate([
            'title' => 'required|string|max:255',
            'website_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:1024', // 1MB Max
            'favicon' => 'nullable|image|max:512',
            'maintenance_mode' => 'boolean',
            'phone' => 'nullable|string|max:15',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        $settings = Setting::first(); // Find existing settings

        // Handle file uploads if new files are uploaded
        if ($this->logo) {
            $settings->logo = $this->logo->store('logos', 'public');
        }
        if ($this->favicon) {
            $settings->favicon = $this->favicon->store('favicons', 'public');
        }

        // Save other settings
        $settings->update([
            'title' => $this->title,
            'website_name' => $this->website_name,
            'description' => $this->description,
            'maintenance_mode' => $this->maintenance_mode,
            'phone' => $this->phone,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
        ]);

        session()->flash('message', 'Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
