<div class="container">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">اضف مرشح جديد</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <!-- Name Field -->
                <div class="form-group mb-3">
                    <label for="name">الاسم</label>
                    <input type="text" wire:model="name" class="form-control" id="name" placeholder="ادخل الاسم">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <!-- slug Field -->
                <div class="form-group mb-3">
                    <label for="slug">slug</label>
                    <input type="text" wire:model="slug" class="form-control" id="slug" placeholder="slug">
                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <!-- Photo Upload Field -->
                <div class="form-group mb-3">
                    <label for="photo">الصورة</label>
                    <input type="file" wire:model="photo" class="form-control-file" id="photo" >
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- CV Field -->
                <div class="mb-3">
                    <label class="form-label" for="inputEmail"></label>
                    <!-- Custom Toolbar -->


                    <!-- Quill Editor -->
                    <div id="quill-container" wire:ignore>
                        <div id="quill-editor" class="mb-3" style="height: 300px;"></div>
                    </div>

                    <!-- Hidden textarea for Livewire binding -->
                    <textarea
                        rows="3"
                        class="mb-3 d-none"
                        name="body"
                        id="quill-editor-area"
                        wire:model="cv"></textarea>

                    @error('cv')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Governorate Field -->
                <div class="form-group mb-3">
                    <label for="governorate_id">المحافظة</label>
                    <select wire:model="governorate_id" class="form-control" id="governorate_id">
                        <option value="">اختر المحافظة</option>
                        @foreach($governorates as $gov)
                            <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                        @endforeach
                    </select>
                    @error('governorate_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Active Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" wire:model="is_active" class="form-check-input" id="is_active">
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        // [{ 'font': [] }],

      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
      [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
      ['blockquote', 'code-block'],
      [{ 'align': [] }],
      [{ 'direction': 'rtl' }],                         // text direction


      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

    //   [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown



      ['clean']                                         // remove formatting button
    ];
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('quill-editor-area')) {
                var editor = new Quill('#quill-editor', {

                    modules: {
        toolbar: toolbarOptions
      },
                    theme:'snow'
                });

                var quillEditorArea = document.getElementById('quill-editor-area');

                // Set initial content from the textarea (useful for editing existing content)
                editor.root.innerHTML = quillEditorArea.value;

                // Sync Quill editor changes to the hidden textarea
                editor.on('text-change', function() {
                    quillEditorArea.value = editor.root.innerHTML;
                    // Use Livewire to update the value
                    @this.set('cv', quillEditorArea.value);
                });

                // Optional: sync textarea changes to the Quill editor (e.g., when loaded via Livewire)
                quillEditorArea.addEventListener('input', function() {
                    editor.root.innerHTML = quillEditorArea.value;
                });

                // Handle Livewire updates (for example, when editing)
                window.addEventListener('load-cv-content', event => {
                    editor.root.innerHTML = event.detail.content;
                    quillEditorArea.value = event.detail.content;
                });
            }
        });
    </script>

@endpush
