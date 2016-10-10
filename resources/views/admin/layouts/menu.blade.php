@php
$user = user();
@endphp
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ Admin::assetContents($user->avatar) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        @foreach(Site::parents() as $parent)
          <li class = "{{ Site::isClassTreeview($parent) }}">
              <a href="{{ Site::urlMenu($parent) }}">
                <i class="fa fa-link"></i> <span>{{ $parent->title }}</span>
              </a>

              @if(Site::countChild($parent) > 0)
                <ul class="treeview-menu">
                  @foreach($parent->childs()->orderBy('order','asc')->get() as $child)
                    <li>
                      <a href="{{ Site::urlMenu($child) }}">{{ $child->title }}</a>
                      @if(Site::countChild($child) > 0)
                        <ul class="treeview-menu">
                          @foreach($child->childs()->orderBy('order','asc')->get() as $grand)
                            <a href="{{ Site::urlMenu($grand) }}">{{ $grand->title }}</a>
                          @endforeach
                        </ul>
                      @endif
                    </li>
                  @endforeach
                </ul>
              @endif

          </li>
        @endforeach
       
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>