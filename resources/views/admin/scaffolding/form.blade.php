@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                  {!! Form::model($model,['files'=>true]) !!}
                    <div class="box-body">
                      
                      @include('admin.flashes.flash')
                      
                      @foreach($forms as $name => $prop)
                        <div class="form-group">
                          <label for="exampleInputEmail1">
                            @if(!empty($prop['label']))

                              {!! $prop['label'] !!}
                            @else
                              {{ ucwords($name) }}
                            @endif
                          </label>

                          <?php
                          if(!empty($prop['properties']))
                          {
                            $properties = $prop['properties'];
                          }else{
                            $properties =  ['class'=>'form-control'];
                          }

                          if(!empty($prop['value']))
                          {
                            $value = $prop['value'];
                          }else{
                            $value = null;
                          }

                          ?>

                          @if($prop['type'] == 'select')
                            {!! Form::{$prop['type']}($name,$prop['selects'],$value ,$properties) !!}
                          @elseif($prop['type'] == 'file')
                              {!! Form::{$prop['type']}($name,$properties) !!}
                          @else
                            {!! Form::{$prop['type']}($name,$value,$properties) !!}
                          @endif
                            
                        </div>
                      @endforeach
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                  {!! Form::close() !!}
                </div>
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection