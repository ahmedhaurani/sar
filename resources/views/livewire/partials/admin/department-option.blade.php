{{-- resources/views/partials/department-option.blade.php --}}
@php
    $prefix = $prefix ?? '';
@endphp

<option value="{{ $department['id'] }}">{{ $prefix . $department['name'] }}</option>

@if (isset($department['children']))
    @foreach ($department['children'] as $child)
        @include('livewire.partials.admin.department-option', ['department' => $child, 'prefix' => $prefix . '0'])
    @endforeach
@endif
