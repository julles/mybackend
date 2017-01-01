@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.scaffolding.content_header')
    <!-- Main content -->
    <section class="content">

      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                  {!! Form::model($model,['files'=>true,'id'=>'mybackend_form']) !!}
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
                              {!! Admin::htmlImage($name,$model->{$name}) !!}
                          @elseif($prop['type'] == 'password')
                              {!! Form::{$prop['type']}($name,$properties) !!}
                          @else
                            {!! Form::{$prop['type']}($name,$value,$properties) !!}
                          @endif
                            
                        </div>
                          @if($prop['type'] == 'file' && !empty($model->{$name}))
                            <div class="form-group">
                              <img id = 'image_<?php $model->{$name} ?>' >
                            </div>
                          @endif
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
@push('scripts')

@if(!empty($validation))
  {!! JsValidator::formRequest($validation,'#mybackend_form') !!}
@endif
@endpush