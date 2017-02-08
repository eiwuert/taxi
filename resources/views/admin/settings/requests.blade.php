
@extends('admin.includes.layout')
@section('header', 'Requests')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i> Setting</a></li>
<li class="active">Requests</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">System requests</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Duration</th>
                    <th>url</th>
                    <th>method</th>
                    <th>ip</th>
                    <th>locale</th>
                    <th>languages</th>
                    <th>charsets</th>
                    <th>encodings</th>
                    <th>isXml</th>
                    <th>proxies</th>
                    <th>parameters</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td>{{ number_format($request['duration'] * 1000) }} ms</td>
                    <td>{{ $request['url'] }}</td>
                    <td>{{ $request['method'] }}</td>
                    <td>{{ $request['ip'] }}</td>
                    <td>{{ $request['locale'] }}</td>
                    <td>{!! implode('<br/>', $request['languages']) !!}</td>
                    <td>{!! implode('<br/>', $request['charsets']) !!}</td>
                    <td>{!! implode('<br/>', $request['encodings']) !!}</td>
                    <td>{{ $request['isXml'] ? 'True' : 'False' }}</td>
                    <td>{!! implode('<br/>', $request['proxies']) !!}</td>
                    {{-- <td>{!! implode('<br/>', $request['parameters']) !!}</td> --}}
                    <td>
                    <table class="table-responsive">
                        <tbody>
                        @foreach($request['parameters'] as $key => $value)
                        <tr>
                            <th>{{ $key }}: </th>
                            <td>{{ is_array($value) ? implode('', $value) : $value }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
                @endforeach
            </tbody></table>
        </div>
        <div class="box-footer">
            @include('admin.includes.pagination', ['resource' => $requests])
        </div>
    </div>
    <!-- /.box -->
</div>
@endsection