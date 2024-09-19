{{-- resources/views/partials/department-option.blade.php --}}
@php
    $prefix = $prefix ?? '';
@endphp

<option value="{{ $department['id'] }}">{{ $prefix . $department['name'] }}</option>

@if (isset($department['children']))
    @foreach ($department['children'] as $child)
        @include('partials.department-option', ['department' => $child, 'prefix' => $prefix . '>> '])
    @endforeach
@endif
