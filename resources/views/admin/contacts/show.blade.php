@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Contacts')
@endsection
@section('header')
@lang('admin/general.Contacts')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-paper-airplane"></i> @lang('admin/general.contacts') </li>
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
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <td># {{ $contact->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admin/general.subject')</th>
                            <td>{{ $contact->subject }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admin/general.email')</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admin/general.text')</th>
                            <td>{{ $contact->text }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admin/general.Created at')</th>
                            <td>{{ $contact->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admin/general.Updated at')</th>
                            <td>{{ $contact->updated_at->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection