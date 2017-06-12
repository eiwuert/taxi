<div class="box box-solid latest-drivers-widget">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="ion-model-s"></i> @lang('admin/general.Latest drivers')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box scrollbar">
            @foreach($drivers as $driver)
            <li class="item">
                <div class="product-img">
                    <img src="{{ $driver->getPicture() }}" alt="driver picture" class="img-circle" width="24">
                </div>
                <div class="product-info">
                    <a href="{{ action('Admin\ClientController@show', ['id' => $driver->id]) }}">
                        <b>{!! $driver->first_name or '<tag color="default"></tag>' !!}</b>
                        <b>{!! $driver->last_name or '<tag color="default"></tag>' !!}</b>
                    </a>
                    <span><small>&bull; {{ $driver->created_at->diffForHumans() }}</small></span>
                    <span class="product-description">{{ $driver->phoneNumber() }} &bull; {{ $driver->stateName() }} &bull; {{ $driver->country }}</span>
                </div>
            </li>
            @endforeach
            <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{ route('drivers.index') }}" class="uppercase">@lang('admin/general.View all drivers')</a>
    </div>
    <!-- /.box-footer -->
</div>