@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Role
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Role</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="box">
                  <div class="box-header with-border">
                    @include('admin.flashes.flash')
                    {!! Admin::linkCreate() !!}
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tbody>
                          <tr>
                            <th>Role</th>
                            <th>Action</th>
                          </tr>
                          <tr>
                          {!! Form::open(['id'=>'form_search']) !!}
                            <td>{{ Form::text('role' , request()->get('role') , ['class'=>'form-control','onblur'=>'search()']) }}</td>
                            <td>-</td>
                          {!! Form::close() !!}
                          </tr>
                        @foreach($lists as $row)  
                          <tr>
                            <td><?= $row->role ?></td>
                            <td>
                              <?= Admin::linkUpdate($row->id) ?>
                              |
                              <?= Admin::linkDelete($row->id) ?>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer clearfix">
                    
                    <?= $lists->render() ?>

                  </div>
                </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('scripts')
<script type="text/javascript">
  function search()
  {
    data = $("#form_search").serialize();
    url = '{{ request()->url }}?'+data;
    document.location.href=url;
  }

  $(document).ready(function(){
    $("#form_search").submit(function(){
      return search();
    });
  });

</script>
@endsection