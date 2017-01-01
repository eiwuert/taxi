@if (isset($name) ? : $name = 'email')
@endif
@if ($errors->has($name))
<email name="{{ isset($name) ? $name : 'email' }}" 
        placeholder="{{ isset($placeholder) ? $placeholder : 'Email' }}"
        value="{{ old($name) }}"
        error="{{ ($errors->first($name)) }}"
        add-class="has-error"></email>
@else
<email name="{{ $name }}" 
        placeholder="{{ isset($placeholder) ? $placeholder : 'Email' }}"
        value="{{ old($name) }}"></email>
@endif
