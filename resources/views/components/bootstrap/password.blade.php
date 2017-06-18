@if (isset($name) ? : $name = 'password')
@endif
@if ($errors->has($name))
 <password name="{{ isset($name) ? $name : 'password' }}" 
        placeholder="{{ isset($placeholder) ? $placeholder : __('admin/general.Password') }}"
        error="{{ ($errors->first($name)) }}"
        add-class="has-error"></password>
@else
<password  name="{{ $name }}" 
        placeholder="{{ isset($placeholder) ? $placeholder : __('admin/general.Password') }}"></password>
@endif
