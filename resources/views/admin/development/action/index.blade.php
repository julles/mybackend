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
              <div class="box">
                  <div class="box-header with-border">
                    @include('admin.flashes.flash')
                    {!! Admin::linkCreate() !!}
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered" id = ''>
                      <thead>
                          <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                      </thead>

                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('scripts')
<script type="text/javascript">
  $(function(){

        $('table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! Admin::urlBackendAction("data") !!}',
        columns: [
            { data: 'code', name: 'code' },
            { data: 'action', name: 'action' },
            { data: 'actions', name: 'actions' ,ordering:false,searchable:'false'},
            
        ]
    });

  });  
</script>
@endpush