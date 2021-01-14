<select 
    class="form-select chosen-select {{ $class ?? '' }}"
    onchange="changeChosen(event, '{{ $model }}')"
    data-placeholder="{{ $placeholder ? $placeholder : '' }}"
    {{ $multiple ? 'multiple="multiple"' : '' }}
    wire:model="{{ $model }}">
    
    {{ $slot }}
    
</select>