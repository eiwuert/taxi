@if (\Request::segment(1) == 'fa')
<span class="pull-left-container">
    <i class="fa fa-angle-left pull-left"></i>
</span>
@else
<span class="pull-right-container">
    <i class="fa fa-angle-right pull-right"></i>
</span>
@endif