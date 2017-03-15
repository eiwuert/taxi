<div class="row">
    <div class="col-xs-6">
        <a class="btn btn-default btn-block btn-sm" href="{{ asset('storage/documents/' . $driver->user->meta->value) }}"><i class="fa fa-cloud-download"></i> Download</a>
    </div>
    <div class="col-xs-6">
        <a class="btn btn-default btn-block btn-sm" href="{{ route('drivers.delete.document', ['driver' => $driver]) }}"><i class="fa fa-times"></i> Delete</a>
    </div>
</div>