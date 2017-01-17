<div class="input-group">
    {{ Form::label($name, $label) }}
    {{ Form::select($name, $items, Request::input($name), ['onchange' => 'this.form.submit()', 'class' => 'form-control input-sm']) }}
</div>