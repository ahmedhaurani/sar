<div class="container mt-4 p-4 rounded">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">
        <div class="card-title">
            <div class="card-body">


                <form wire:submit.prevent="saveSettings">
                    <div class="mb-3">
                        <label for="title" class="form-label">Website Title</label>
                        <input type="text" id="title" wire:model="title" class="form-control" />
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website_name" class="form-label">Website name</label>
                        <input type="text" id="website_name" wire:model="website_name" class="form-control" />
                        @error('website_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Website Description</label>
                        <textarea id="description" wire:model="description" class="form-control"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" id="logo" wire:model="logo" class="form-control" />
                        @if ($logo)
                        <img src="{{ $logo->temporaryUrl() }}" alt="Logo Preview" class="img-fluid mt-2" width="150"
                            height="150">
                        @elseif($current_logo)
                        <img src="{{ asset('storage/'.$current_logo) }}" alt="Current Logo" class="img-fluid mt-2"
                            width="150" height="150">
                        @endif
                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="favicon" class="form-label">Favicon</label>
                        <input type="file" id="favicon" wire:model="favicon" class="form-control" />
                        @if ($favicon)
                        <img src="{{ $favicon->temporaryUrl() }}" alt="Favicon Preview" class="img-fluid mt-2"
                            width="32" height="32">
                        @elseif($current_favicon)
                        <img src="{{ asset('storage/'.$current_favicon) }}" alt="Current Favicon" class="img-fluid mt-2"
                            width="32" height="32">
                        @endif
                        @error('favicon') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="maintenance_mode" class="form-label">Maintenance Mode</label>
                        <select id="maintenance_mode" wire:model="maintenance_mode" class="form-control">
                            <option value="0">Disabled</option>
                            <option value="1">Enabled</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" id="phone" wire:model="phone" class="form-control" />
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="facebook" class="form-label">Facebook URL</label>
                        <input type="url" id="facebook" wire:model="facebook" class="form-control" />
                        @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="twitter" class="form-label">Twitter URL</label>
                        <input type="url" id="twitter" wire:model="twitter" class="form-control" />
                        @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>
