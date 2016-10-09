</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ Admin::assetAdmin() }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ Admin::assetAdmin() }}/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ Admin::assetAdmin() }}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@stack('scripts')
</body>
</html>
