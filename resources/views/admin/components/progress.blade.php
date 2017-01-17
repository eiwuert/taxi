<div class="progress-group">
    <span class="progress-text">{{ $name }}</span>
    <span class="progress-number"><b>{{ $progress }}</b>/{{ $total }}</span>
    <div class="progress sm">
        <div class="progress-bar progress-bar-aqua" style="width: {{ (($progress / $total) * 100)}}%"></div>
    </div>
</div>
<!-- /.progress-group -->
