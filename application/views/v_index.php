<?php include 'config/header.php'; ?>
    <div class="container-fluid">
    <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
          <?php include 'config/menu.php'; ?>
          <div class="col-xs-12 col-sm-9 content">
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title"> <?php echo $judul; ?></h2>
              </div>

              <div class="panel-body">
                <div class="content-row">
                  <div class="row">
                    <div class="col-md-12">
                     <?php include $konten.'.php'; ?>
                    </div>
                  </div>
                </div>     
              </div>
            </div><!-- panel body -->
            <div style="margin-bottom : 65px;"></div>
        </div><!-- content -->
      </div>
    </div>
    <!--footer-->
    <?php include 'config/footer.php'; ?>
    <script src="assets/bootstrap-datepicker.js"></script>
  
    <script type="text/javascript">
      $('.year').datepicker({
        minViewMode: 2,
        format: 'yyyy'
      });
      $('.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        //startView: 2,
        todayBtn: true,
        todayHighlight: true,
        //clearBtn: true,
        language: 'id'
      });
      $('#rupiah').mask('000.000.000.000');
  </script>