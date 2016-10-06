<section class="content-header">
  <h1>
    {{ Admin::labelMenu() }}
    <small>{{ Admin::labelAction() }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#">{{ Admin::labelParentMenu() }}</a></li>
    <li><a href="{{ Admin::urlBackendAction('index') }}">{{ Admin::labelMenu() }}</a></li>
    <li class="active">{{Admin::labelAction() }}</li>
  </ol>
</section>