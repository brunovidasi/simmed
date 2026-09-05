<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SimMed</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/assets/gentelella/build'); ?>/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center">
              <h1 class="error-number"><?php echo $caso->nome; ?></h1>
              <h2></h2>
              <p>Clique no botão abaixo para iniciar a simulação do caso clínico</a>
              </p>
              <div class="mid_center">
                <!-- <h3>Search</h3> -->
                <form>
                  <div class="col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <a href="<?php echo base_url('simulador/iniciar_caso/'.$caso->caso_clinico_id); ?>" class="btn btn-success btn-lg">INICIAR CASO CLÍNICO</a>
                      <a href="<?php echo base_url('acesso/sair/'); ?>" class="btn btn-danger btn-lg">SAIR</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('/assets/gentelella/build'); ?>/js/custom.min.js"></script>
  </body>
</html>