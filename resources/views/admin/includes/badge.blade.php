@if ($string > 0 || is_string($string))
@if (\Request::segment(1) == 'fa')
<span class="pull-left-container">
    <small class="label pull-left bg-blue badge">{{ convert($string) }}</small>
</span>
@else
<span class="pull-right-container">
    <small class="label pull-right bg-blue badge">{{ $string }}</small>
</span>
@endif
@endif