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

            <form method="post" action="<?php echo base_url('caso_clinico/insert/'); ?>">

            <div class="row">

              <div class="col-md-6 col-xs-12">

                <div class="col-md-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-heartbeat"></i> Caso Clínico <small>Dados gerais</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br>
                      <div class="form-horizontal form-label-left input_mask">

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <input type="text" name="nome" value="<?php echo set_value('nome'); ?>" required="required" class="form-control has-feedback-left" placeholder="Nome">
                          <span class="fa fa-heartbeat form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" name="numero" value="<?php echo set_value('numero'); ?>" required="required" class="form-control has-feedback-left" placeholder="Número">
                          <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" name="cid" value="<?php echo set_value('cid'); ?>" required="required" class="form-control" placeholder="CID">
                          <span class="fa fa-suitcase form-control-feedback right" aria-hidden="true"></span>
                        </div>

                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <textarea type="text" name="diagnostico" required="required" class="form-control col-md-7 col-xs-12" rows="10"><?php echo set_value('diagnostico', 'Diagnóstico'); ?></textarea>
                          </div>

                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <textarea type="text" name="prescricao" required="required" class="form-control col-md-7 col-xs-12" rows="10"><?php echo set_value('prescricao', 'Prescrição'); ?></textarea>
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

                        <div class="ln_solid"></div>
                        <!-- <div class="form-group">
                          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div> -->

                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-user-md"></i> Especialidades <small></small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br>
                      <div class="form-horizontal form-label-left">
                          
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

                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-user"></i> Usuários <small></small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="form-horizontal form-label-left">

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
                    </div>
                  </div>
                </div>

              </div>

              <div class="col-md-6 col-xs-12">

                <div class="col-md-12 col-xs-12">
                  <button type="submit" class="btn btn-success btn-lg col-md-12">Cadastrar Caso Clínico</button>
                </div>

                <div class="col-md-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-medkit"></i> Variáveis Clínicas <small></small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br>
                      <div class="form-horizontal form-label-left">

                          <div class="vr_box">

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Variável Clínica <span class="required"></span>
                              </label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" name="variavel_clinica[]" tabindex="-1">
                                  <?php foreach($variavel_clinicas as $variavel_clinica){ ?>
                                    <option value="<?php echo $variavel_clinica->variavel_clinica_id; ?>"><?php echo $variavel_clinica->nome . ' - ' . $variavel_clinica->comando; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Texto <span class="required"></span>
                              </label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea type="text" id="first-name" name="texto[]" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('texto'); ?></textarea>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto <span class="required"></span>
                              </label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
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
                              <div class="col-md-9 col-sm-9 col-xs-12">
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
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea type="text" id="first-name" name="texto[]" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('texto'); ?></textarea>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto <span class="required">*</span>
                              </label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
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

                          </div>
                    </div>
                  </div>
                </div>

              </div>

              

              

            </div>

            </form>

          </div>