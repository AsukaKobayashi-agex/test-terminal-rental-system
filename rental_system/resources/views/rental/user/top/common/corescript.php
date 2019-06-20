  <!-- Bootstrap core JavaScript-->
  <script src="/bootsample/vendor/jquery/jquery.min.js"></script>
  <script src="/bootsample/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/bootsample/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/bootsample/js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
      function submitAction(url) {
          $('form').attr('action', url);
          $('form').submit();
      }

      function checkValue(check){
          if(check.checked){
              $('.bundle').removeAttr('disabled')
          }
      }
      $('#checkAll').click(function () {
          $('input:checkbox').prop('checked', this.checked);
          $('.bundle').removeAttr('disabled')

      });

  </script>


