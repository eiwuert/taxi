<div class="checkbox icheck">
    <checkbox name="{{ $name }}" label="{{ $label }}"></checkbox>
</div>

@push('style')
<link rel="stylesheet" href="{{ mix('css/admin/iCheckBlue.css') }}">
@endpush

@push('js')
<script src="{{ mix('js/admin/iCheck.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue'
        });
    });
</script>
@endpush