@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Currencies')
@endsection
@section('header')
<a href="{{ route('currencies.create') }}">
    <button class="btn btn-primary btn-xs">
    @lang('admin/general.New currency')
    </button>
</a> 
@lang('admin/general.Currencies')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-pricetags"></i>@lang('admin/general.currencies') </li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('admin/general.List')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                @if(!$currencies->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.Name')</th>
                            <th>@lang('admin/general.Symbol')</th>
                            <th>@lang('admin/general.Created at')</th>
                            <th>@lang('admin/general.Updated at')</th>
                        </tr>
                        @foreach($currencies as $currency)
                        <tr onclick="window.document.location='{{ action('Admin\CurrencyController@edit', ['currency' => $currency]) }}';" style="cursor: pointer;">
                            <td># {{ $currency->id }}</td>
                            <td>{{ $currency->name }}</td>
                            <td>{{ $currency->symbol }}</td>
                            <td>{{ $currency->created_at->diffForHumans() }}</td>
                            <td>{{ $currency->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                @include('admin.components.empty')
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                @include('admin.includes.pagination', ['resource' => $currencies])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection