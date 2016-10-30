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
                          @foreach($fields as $key => $prop)
                            <?php
                            if(is_numeric($key))
                            {
                              $key = $prop;
                              $prop = ['enabled'=>true];
                            }

                            if(!array_key_exists('enabled',$prop))
                            {
                              $prop['enabled'] = true;
                            }
                            if($prop['enabled'] == false)
                            {
                              continue;
                            }
                            $label = isset($prop['label']) ? $prop['label'] : ucwords($key);
                            ?>
                                <th>{{ $label }}</th>
                          @endforeach
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
  <?php
  $result = [];
  foreach($fields as $key => $val)
  {
    if(is_numeric($key))
    {
      $key = $val;
      $val = ['enabled'=>true];
    }

    if($val['enabled'] == false)
    {
      continue;
    }

    $alias = is_numeric($key) ? $val : $key;
    $result [] = ['data'=>$alias , 'name'=>$alias];
  }

    $result[]  = ['data' => 'action','name'=>'action','ordering'=> false,'searchable'=>false];
    $flatt = json_encode(Admin::array_key_flatten($fields));
  ?>
<script type="text/javascript">
  $(function(){

        $('table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : '{!! Admin::urlData() !!}',
          "data": function ( d ) {
                d.fields = {!! $flatt !!};
                d.model = '{{ $model }}';
                d.menu = '{{ Admin::rawMenu() }}';
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        columns: {!! json_encode($result) !!},

    });

  });
</script>
@endpush
