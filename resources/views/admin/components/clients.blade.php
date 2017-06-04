<div class="box box-solid latest-clients-widget">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('admin/general.Latest clients')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box scrollbar">
            @foreach($clients as $client)
            <li class="item">
                <div class="product-img">
                    <img src="{{ $client->getPicture() }}" alt="driver picture" class="img-circle" width="24">
                </div>
                <div class="product-info">
                    <a href="{{ action('Admin\ClientController@show', ['id' => $client->id]) }}">
                        <b>{!! $client->first_name or '<tag color="default"></tag>' !!}</b>
                        <b>{!! $client->last_name or '<tag color="default"></tag>' !!}</b>
                    </a>
                    <span><small>&bull; {{ $client->created_at->diffForHumans() }}</small></span>
                    <span class="product-description">{{ $client->phoneNumber() }} &bull; {{ $client->stateName() }} &bull; {{ $client->country }}</span>
                </div>
            </li>
            @endforeach
            <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{ route('clients.index') }}" class="uppercase">@lang('admin/general.View all clients')</a>
    </div>
    <!-- /.box-footer -->
</div>