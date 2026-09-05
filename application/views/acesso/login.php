<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SimMed</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('/assets/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('/assets/gentelella/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/assets/gentelella/build'); ?>/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php print base_url('acesso/logar') ?>" method="post">
              <h1>SimMed</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Nome de Usuário" required="" />
                <input type="hidden" name="redirect" value="<?php if(isset($_GET['pg'])) echo $_GET['pg']; ?>" />
              </div>
              <div>
                <input type="password" name="senha" class="form-control" placeholder="Senha" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" >Entrar</button>
              </div>

              <div class="clearfix"></div>

              <?php if(isset($_GET['msg'])){ ?>
                <div align="center" style="color:red;">
                 <strong><?php

                  if($_GET['msg'] == '1') echo "Empresa desativada";
                  if($_GET['msg'] == '2') echo "Usuário ou Senha incorretos"; // senha incorreta
                  if($_GET['msg'] == '3') echo "Usuário ou Senha incorretos"; // usuario incorreto
                  if($_GET['msg'] == '4') echo "Não existe caso clínico para esse usuário."; // Sem caso clínico

                 ?></strong>
                </div>
              <?php } ?>

              <div class="separator">
                <div>
                  <h1><i class="fa fa-stethoscope"></i> SimMed</h1>
                  <p>©2016 Todos os direitos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
