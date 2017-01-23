@if (! is_null($trip->rate))
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">Rate</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @if ($trip->rate->driver != '')
        <!-- Message. Default to the left -->
        <div class="direct-chat-msg">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left">{{ $trip->driver->first_name }} {{ $trip->driver->last_name }}</span>
                <span class="direct-chat-timestamp pull-right">@include('admin.includes.stars', ['stars' => $trip->rate->driver])</span>
            </div>
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="{{ $trip->driver->getPicture() }}" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                {!!  $trip->rate->driver_comment or '<tag color="default"></tag>' !!}
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->
        @endif
        @if ($trip->rate->client != '')
        <!-- Message to the right -->
        <div class="direct-chat-msg right">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-right">{{ $trip->client->first_name }} {{ $trip->client->last_name }}</span>
                <span class="direct-chat-timestamp pull-left">@include('admin.includes.stars', ['stars' => $trip->rate->client])</span>
            </div>
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="{{ $trip->client->getPicture() }}" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                {!! $trip->rate->client_comment or '<tag color="default"></tag>' !!}
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->
        @endif
    </div>
    <!-- /.box-body -->
</div>
@endif