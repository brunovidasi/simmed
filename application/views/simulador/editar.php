<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Editar Especialidade Médica</h3>
              </div>

              <?php 
              require('application/views/includes/mensagem.php');
              if(validation_errors() != '')
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><ul>".validation_errors('<li>', '</li>')."</ul></div> <br />";
              ?>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left input_mask" role="form" method="post" action="<?php echo base_url('especialidade/update/'.$especialidade->especialidade_medica_id); ?>">

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nome" name="nome" value="<?php echo set_value('nome', $especialidade->nome); ?>" required>
                        <span class="fa fa-user-md form-control-feedback left" aria-hidden="true"></span>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <input type="hidden" name="especialidade_medica_id" value="<?php echo $especialidade->especialidade_medica_id; ?>" />
                          <button type="submit" class="btn btn-success">Confirmar Alterações</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>