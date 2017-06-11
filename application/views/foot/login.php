<!-- Mainly scripts -->
<script src="<?= base_url('assets/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>