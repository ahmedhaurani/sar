<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Edit Candidate</h4>
        </div>

        <div class="card-body">
            <!-- Success Message -->
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <form wire:submit.prevent="update">
                <!-- Candidate Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" wire:model="name" class="form-control" id="name"
                        placeholder="Enter candidate's name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Candidate Photo -->
                <div class="form-group mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" wire:model="photo" class="form-control-file" id="photo">
                    @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="img-thumbnail mt-2" width="150">
                    @elseif($currentPhoto)
                    <!-- Check if the current photo exists -->
                    <img src="{{ asset('storage/' . $currentPhoto) }}" alt="Current Photo" class="img-thumbnail mt-2"
                        width="150">
                    @endif
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Candidate CV -->
                {{-- <div class="form-group mb-3">
                    <label for="cv" class="form-label">السيرة الذاتية</label>
                    <div id="cv" style="height: 200px;"></div>
                    <textarea wire:model="cv" class="d-none" id="cv"></textarea>
                    @error('cv') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}
                {{-- <div class="form-group mb-3">
                    <label for="cv" class="form-label">cv</label>
                    <input type="text" wire:model="cv" class="form-control" id="cv" placeholder="Enter candidate's cv">
                    @error('cv') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}

                {{-- <div class="form-group mb-3">
                    <label>السيرة الذاتية {{ $cv }}</label>
                    <!-- Quill Editor Placeholder -->
                    <div wire:ignore style="height: 200px;">
                        <!-- Hidden Textarea for Livewire Binding -->
                        <textarea class="form-control" id="cv" wire:model='cv'></textarea>
                    </div>
                    @error('cv') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}

                00
                <div class="form-group mb-3">
                    <div wire:ignore style="height: 200px;">
                        <textarea name="cv" id="cv" cols="30" rows="10" wire:model='cv'>{{ $cv }}</textarea>
                    </div>
                </div>
                00
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>

                <!-- Governorate -->
                <div class="form-group mb-3">
                    <label for="governorate_id" class="form-label">Governorate</label>
                    <select wire:model="governorate_id" class="form-control" id="governorate_id">
                        <option value="">Select Governorate</option>
                        @foreach($governorates as $gov)
                        <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                        @endforeach
                    </select>
                    @error('governorate_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Active Status -->
                <div class="form-check mb-3">
                    <input type="checkbox" wire:model="is_active" class="form-check-input" id="is_active">
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">Update Candidate</button>
                <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary mt-3">Back</a>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cv').summernote({
            placeholder: 'Enter CV...',
            tabsize: 2,
            height: 300,
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('cv', contents);
                }
            }
        });
    });
</script>
@endpush
