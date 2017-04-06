<div class="input-group">
    <label>Export</label>
    <br>
    <div class="btn-group" role="group" aria-label="export">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Type
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ Request::fullUrl() }}{{ count($_GET) ? '&' : '?' }}export=&#10003;&type=pdf">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> pdf</a></li>
                <li><a href="{{ Request::fullUrl() }}{{ count($_GET) ? '&' : '?' }}export=&#10003;&type=csv">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> csv</a></li>
                <li><a href="{{ Request::fullUrl() }}{{ count($_GET) ? '&' : '?' }}export=&#10003;&type=xls">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> xls</a></li>
                <li><a href="{{ Request::fullUrl() }}{{ count($_GET) ? '&' : '?' }}export=&#10003;&type=xlsx">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> xlsx</a></li>
            </ul>
        </div>
    </div>
</div>