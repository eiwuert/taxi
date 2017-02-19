@extends('admin.includes.layout')
@section('title')
Profile
@endsection
@section('header')
Profile
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active">Profile</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    @include('admin.errors.form')
    {!! Form::model($profile, ['method' => 'POST', 'action' => ['Admin\WebController@update'], 'class' => 'form-horizontal', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('first_name', 'First name: ', ['class' => 'col-sm-2 control-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
        <p class="help-block">Max 24 characters.</p>
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('last_name', 'Last name: ', ['class' => 'col-sm-2 control-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
        <p class="help-block">Max 24 charecters.</p>
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('picture', 'Picture: ', ['class' => 'col-sm-2 control-label']) !!}
      <div class="col-sm-10">
          <img src="{{ $profile->picture }}" width="128" height="128" class="img-responsive img-circle">
          {!! Form::file('picture', ['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection
