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
                @if(!$contacts->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.subject')</th>
                            <th>@lang('admin/general.email')</th>
                            <th>@lang('admin/general.text')</th>
                            <th>@lang('admin/general.Created at')</th>
                            <th>@lang('admin/general.Updated at')</th>
                        </tr>
                        @foreach($contacts as $contact)
                        <tr onclick="window.document.location='{{ action('Admin\ContactController@show', ['contact' => $contact]) }}';" style="cursor: pointer;">
                            <td># {{ $contact->id }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->text }}</td>
                            <td>{{ $contact->created_at->diffForHumans() }}</td>
                            <td>{{ $contact->updated_at->diffForHumans() }}</td>
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
                @include('admin.includes.pagination', ['resource' => $contacts])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection