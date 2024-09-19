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
                    <!-- Quill Editor Placeholder -->
                    <div id="quill-editor" style="height: 200px;"></div>
                    <!-- Hidden Textarea for Livewire Binding -->
                    <textarea wire:model.defer="cv" class="d-none" id="quill-editor-area"></textarea>
                    @error('cv') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}

                {{-- <div class="form-group mb-3">
                    <label for="cv" class="form-label">cv</label>
                    <input type="text" wire:model="cv" class="form-control" id="cv"
                        placeholder="Enter candidate's name">

                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}


                {{-- <div class="mb-3">
                    <label class="form-label" for="inputEmail">Body:</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;">
                    </div>
                    <textarea rows="3" class="mb-3 d-none" name="body" id="quill-editor-area"></textarea>


                    @error('body')
                    <span class="text-danger">{{ $message }}</span>
                    @endif
                </div> --}}

                <div class="form-group mb-3">
                    <label>السيرة الذاتية {{ $cv }}</label>
                    <!-- Quill Editor Placeholder -->
                    <div wire:ignore style="height: 200px;">
                        <!-- Hidden Textarea for Livewire Binding -->
                        <textarea class="form-control" id="cv" wire:model='cv'></textarea>
                    </div>
                    @error('cv') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                {{-- <div class="mb-4">
                    <div wire:ignore>
                        <div x-data x-ref="editor" x-init="
        const quill newQuill($refs.editor,{
        theme='snow'
        });
        quill.on('text-change', () => {
        $wire.set('body',quill.root.innerHTML)
        })">
                        </div>
                    </div>cc --}}
                    <div id="quill-editor" class="mb-3" style="height: 300px;"></div>
                    <textarea rows="3" class="mb-3 d-none" id="quill-editor-area" wire:model.defer="cv"></textarea>

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

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('quill-editor-area')) {
        var editor = new Quill('#quill-editor', {
            theme: 'snow'
        });
        var quillEditor = document.getElementById('quill-editor-area');

        // Set initial content from the textarea (Livewire model) into Quill
        editor.root.innerHTML = quillEditor.value;

        // Sync Quill editor changes to the hidden textarea (Livewire model)
        editor.on('text-change', function() {
            quillEditor.value = editor.root.innerHTML;
          //  @this.set('cv', quillEditor.value); // Update Livewire model
        });

        // Sync the content from Livewire to the Quill editor (useful when editing an existing CV)
        window.addEventListener('load-cv-content', event => {
            editor.root.innerHTML = event.detail.content;
        //    quillEditor.value = event.detail.content; // Sync with textarea
        });
    }
});
</script> --}}

{{-- <script>
    const quill = new Quill("#editor", {
      theme: "snow",
    });
</script> --}}

<script>
    $('#cv').summernote({
        placeholder: 'enter',
      tabsize: 2,
      height: 100,
      direction: 'ltr',  // Set text direction to right-to-left
      toolbar: [
            // Customize toolbar options
            ['color', ['color']],  // Move color options to the first position
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
      callbacks: {
    onChange: function(contents, $editable) {
      $this.set('cv', contents);
    }
  }
    });
</script>
@endpush
