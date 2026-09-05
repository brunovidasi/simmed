<div class="">
            <div class="page-title">
              <div class="title_left">
                <!-- <h3>Cadastrar Caso Clínico</h3> -->
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cadastro <small>Caso Clínico</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <!-- <p>Preste atenção na hora de cadastrar o caso clínico.</p> -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no"><i class="fa fa-stethoscope"></i></span>
                            <span class="step_descr">
                                              Passo 1<br />
                                              <small>Caso clínico</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no"><i class="fa fa-medkit"></i></span>
                            <span class="step_descr">
                                              Passo 2<br />
                                              <small>Variáveis Clínica</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no"><i class="fa fa-user-md"></i></span>
                            <span class="step_descr">
                                              Passo 3<br />
                                              <small>Especialidades</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no"><i class="fa fa-user"></i></span>
                            <span class="step_descr">
                                              Passo 4<br />
                                              <small>Usuário Responsável</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">

                        <form class="form-horizontal form-label-left">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="first-name" name="nome" value="<?php echo set_value('nome'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Número <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="first-name" name="numero" value="<?php echo set_value('numero'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CID <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="first-name" name="cid" value="<?php echo set_value('cid'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Diagnóstico <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea type="text" id="first-name" name="diagnostico" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('diagnostico'); ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Prescrição <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea type="text" id="first-name" name="prescricao" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('prescricao'); ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alta</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="checkbox" name="alta" class="js-switch" />
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Internação</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="checkbox" name="internacao" class="js-switch" />
                            </div>
                          </div>

                          </form>
                        

                      </div>
                      <div id="step-2">

                        <!-- ------ -->

                        <form class="form-horizontal form-label-left">

                        <div class="vr_box">

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Variável Clínica <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="select2_single form-control" name="variavel_clinica[]" tabindex="-1">
                                <?php foreach($variavel_clinicas as $variavel_clinica){ ?>
                                  <option value="<?php echo $variavel_clinica->variavel_clinica_id; ?>"><?php echo $variavel_clinica->nome . ' - ' . $variavel_clinica->comando; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Texto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea type="text" id="first-name" name="texto[]" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('texto'); ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="foto" name="foto[]" value="<?php echo set_value('foto'); ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Obrigatório</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="checkbox" name="obrigatorio[]" class="js-switch" />
                            </div>
                          </div>

                        </div>

                        <a class="btn btn-primary add_vr pull-right"><i class="fa fa-plus"></i></a> 

                        <script>

                          $('.add_vr').click(function(){

                            $('.vr_box').append(`<hr /> <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Variável Clínica <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="select2_single form-control" name="variavel_clinica[]" tabindex="-1">
                                <?php foreach($variavel_clinicas as $variavel_clinica){ ?>
                                  <option value="<?php echo $variavel_clinica->variavel_clinica_id; ?>"><?php echo $variavel_clinica->nome . ' - ' . $variavel_clinica->comando; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Texto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea type="text" id="first-name" name="texto[]" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('texto'); ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="foto" name="foto[]" value="<?php echo set_value('foto'); ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Obrigatório</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="checkbox" name="obrigatorio[]" class="js-switch" />
                            </div>
                          </div>`);

                          });

                        </script>

                        <!-- ------ -->

                        </form>
                      
                      </div>
                      <div id="step-3">

                        <form class="form-horizontal form-label-left">
                        
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Especialidade Principal</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" name="especialidade_principal" tabindex="-1">
                            <?php foreach($especialidades as $especialidade){ ?>
                              <option value="<?php echo $especialidade->especialidade_medica_id; ?>"><?php echo $especialidade->nome; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Especialidades Secundárias</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_multiple form-control" name="especialidade_secundaria[]" multiple="multiple">
                            <?php foreach($especialidades as $especialidade){ ?>
                              <option value="<?php echo $especialidade->especialidade_medica_id; ?>"><?php echo $especialidade->nome; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      </form>

                      </div>

                      <div id="step-4">

                      <form class="form-horizontal form-label-left">

                        <h2 class="StepTitle">Selecione os usuários que irão participar da simulação deste caso clínico</h2>

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuários</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_multiple form-control" name="usuarios[]" multiple="multiple">
                            <?php foreach($usuarios as $usuario){ ?>
                              <option value="<?php echo $usuario->usuario_id; ?>"><?php echo $usuario->login; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      </div>

                    </form>
                    </div>

                    <!-- End SmartWizard Content -->

                  </div>
                </div>
              </div>


            </div>

          </div>