<div class="checkbox icheck">
    <checkbox name="{{ $name }}" label="{{ $label }}"></checkbox>
</div>

@push('style')
<link rel="stylesheet" href="{{ elixir('css/admin/iCheckBlue.css') }}">
@endpush

@push('js')
<script src="{{ elixir('js/admin/icheck.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue'
        });
    });
</script>
@endpush