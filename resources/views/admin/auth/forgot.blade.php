@extends('admin.layouts.auth.layout')
@section('content')
  <!-- /.login-logo -->
  @include('admin.flashes.flash')
  <div class="login-box-body">
    <p class="login-box-msg">Send new password to my email</p>

    {!! Form::open() !!}
      <div class="form-group has-feedback">
        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="{{ url('login') }}">Back To Login</a><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    {!! Form::close() !!}
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
@endsection