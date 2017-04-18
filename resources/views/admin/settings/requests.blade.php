
@extends('admin.includes.layout')
@section('header', 'Requests')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i>@lang('admin/general.Setting')</a></li>
<li class="active">@lang('admin/general.Requests')</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.System requests')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>@lang('admin/general.Duration')</th>
                    <th>@lang('admin/general.url')</th>
                    <th>@lang('admin/general.method')</th>
                    <th>@lang('admin/general.ip')</th>
                    <th>@lang('admin/general.locale')</th>
                    <th>@lang('admin/general.languages')</th>
                    <th>@lang('admin/general.charsets')</th>
                    <th>@lang('admin/general.encodings')</th>
                    <th>@lang('admin/general.isXml')</th>
                    <th>@lang('admin/general.proxies')</th>
                    <th>@lang('admin/general.parameters')</th>
                    <th>@lang('admin/general.created')</th>
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
                    {{-- Extracting time from _id --}}
                    <td>{{ $request->diff }}</td>
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
