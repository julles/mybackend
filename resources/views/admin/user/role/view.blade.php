@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @include('admin.scaffolding.content_header')
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                  {!! Form::model($model) !!}
                    <div class="box-body">
                      
                      @include('admin.flashes.flash')
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
                        <?= Form::text('role' , null , ['class'=>'form-control','readonly'=>true]) ?>
                      </div>
                      
                      <div>
                          <table class="table">
                            <thead>
                              <th>Menu</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                              <?php $no=1; ?>
                              @foreach($menus as $parent)
                                <tr style="background-color:#D1E1E9;">  
                                  <td>{{ $parent->title }}</td>
                                  <td>
                                    @if(!empty(Site::countActionFromMenu($parent)))
                                      @foreach($parent->actions as $parentAction)
                                        <input {{ Site::whileChildTrChecked($parent,$parentAction) }} name="menu_action_id[]" value="{{ $parentAction->pivot->id }}" type = 'checkbox' /> {{ $parentAction->action }}
                                      @endforeach
                                    @endif
                                  </td>
                                </tr>

                                  {!! Site::whileChildTr($parent->childs,$no) !!}

                              @endforeach
                            </tbody>
                          </table>
                      </div>

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