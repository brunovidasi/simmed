<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $caso_clinico->nome; ?></h3>
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

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content0" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Editar</a>
                    </li>

                    <?php foreach($casos as $caso){ ?>

                    <li role="presentation" class=""><a href="#tab_content-<?php echo $caso->usuario_id; ?>" role="tab" id="user-tab-<?php echo $caso->usuario_id; ?>" data-toggle="tab" aria-expanded="false"><?php echo $caso->usuario; ?></a>
                    </li>

                    <?php } ?>


                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content0" aria-labelledby="home-tab">
                      

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
                                  <input type="text" name="nome" value="<?php echo set_value('nome', $caso_clinico->nome); ?>" required="required" class="form-control has-feedback-left" placeholder="Nome">
                                  <span class="fa fa-heartbeat form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" name="numero" value="<?php echo set_value('numero', $caso_clinico->numero); ?>" required="required" class="form-control has-feedback-left" placeholder="Número">
                                  <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" name="cid" value="<?php echo set_value('cid', $caso_clinico->cid); ?>" required="required" class="form-control" placeholder="CID">
                                  <span class="fa fa-suitcase form-control-feedback right" aria-hidden="true"></span>
                                </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <textarea type="text" name="diagnostico" required="required" class="form-control col-md-7 col-xs-12" rows="10"><?php echo set_value('diagnostico', $caso_clinico->diagnostico); ?></textarea>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <textarea type="text" name="prescricao" required="required" class="form-control col-md-7 col-xs-12" rows="10"><?php echo set_value('prescricao', $caso_clinico->prescricao); ?></textarea>
                                  </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Alta</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="checkbox" name="alta" class="js-switch" <?php echo (set_value('alta', $caso_clinico->alta) == 1) ? 'checked' : ''; ?>/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Internação</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="checkbox" name="internacao" class="js-switch" <?php echo (set_value('internacao', $caso_clinico->internacao) == 1) ? 'checked' : ''; ?>/>
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
                                        <option value="<?php echo $especialidade->especialidade_medica_id; ?>" <?php echo (set_value('especialidade_principal', $caso_clinico->area_principal_id) == $especialidade->especialidade_medica_id) ? 'selected' : ''; ?>><?php echo $especialidade->nome; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Especialidades Secundárias</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="select2_multiple form-control" name="especialidade_secundaria[]" multiple="multiple">
                                      <?php foreach($especialidades as $especialidade){ ?>
                                        <?php 
                                            $selected = "";
                                        foreach($area_secundarias as $area_secundaria){
                                            if($area_secundaria->especialidade_medica_id == $especialidade->especialidade_medica_id)
                                             $selected = 'selected';
                                          } ?>
                                        <option value="<?php echo $especialidade->especialidade_medica_id; ?>" <?php echo $selected; ?>><?php echo $especialidade->nome; ?></option>
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

                                        <?php 
                                            $selected = "";
                                        foreach($grupos as $grupo){
                                            if($grupo->usuario_id == $usuario->usuario_id)
                                             $selected = 'selected';
                                          } ?>
                                        <option value="<?php echo $usuario->usuario_id; ?>" <?php echo $selected; ?>><?php echo $usuario->login; ?></option>
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
                          <button type="submit" class="btn btn-success btn-lg col-md-12">Editar Caso Clínico</button>
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

                                  <?php 
                                  $j = 0;
                                  foreach($variaveis as $variavel){ 

                                    if($j != 0)
                                      echo '<hr />';

                                    $j++;
                                  ?>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Variável Clínica <span class="required"></span>
                                      </label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" name="variavel_clinica[<?php echo $variavel->variavel_clinica_id; ?>]" tabindex="-1">
                                          <?php foreach($variavel_clinicas as $variavel_clinica){ ?>
                                            <option value="<?php echo $variavel_clinica->variavel_clinica_id; ?>" <?php echo ($variavel->variavel_clinica_id == $variavel_clinica->variavel_clinica_id) ? 'selected' : ''; ?>><?php echo $variavel_clinica->nome . ' - ' . $variavel_clinica->comando; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Texto <span class="required"></span>
                                      </label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea type="text" id="first-name" name="texto[<?php echo $variavel->variavel_clinica_id; ?>]" required="required" class="form-control col-md-7 col-xs-12"><?php echo set_value('texto[]', $variavel->texto); ?></textarea>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto <span class="required"></span>
                                      </label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="file" id="foto" name="foto[<?php echo $variavel->variavel_clinica_id; ?>]" value="<?php echo set_value('foto'); ?>" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Obrigatório</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="checkbox" name="obrigatorio[<?php echo $variavel->variavel_clinica_id; ?>]" class="js-switch" <?php echo (set_value('obrigatorio['.$variavel->variavel_clinica_id.']', $variavel->obrigatorio) == 1) ? 'checked' : ''; ?>/>
                                      </div>
                                    </div>

                                  <?php } ?>
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

                    <?php foreach($casos as $caso){ ?>

                    <div role="tabpanel" class="tab-pane fade" id="tab_content-<?php echo $caso->usuario_id; ?>" aria-labelledby="user-tab-<?php echo $caso->usuario_id; ?>">
                      
                      <div class="row tile_count">
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa-user"></i> <?php echo $caso->usuario; ?></span>
                          <span class="count_bottom"><i class="green"></i><br />Cad: <?php echo fdatetime($caso->data_cadastro, '/'); ?> <br />
                          <i class="green"></i>Início: <?php echo fdatetime($caso->data_inicio, '/'); ?> <br />
                          <i class="green"></i>Fim: <?php echo fdatetime($caso->data_fim, '/'); ?></span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa-clock-o"></i> Tempo de Execução</span>
                          <div class="count" style="    font-size: 26px;"><?php 
                            if(!empty($caso->data_inicio)){
                              if(!empty($caso->data_fim))
                                echo calcular_horas($caso->data_fim, $caso->data_inicio);
                              else
                                echo calcular_horas(date('Y-m-d H:i:s'), $caso->data_inicio);
                            }else{
                              echo '0';
                            }

                          ?></div>
                          <span class="count_bottom"><i class="green"></i>No caso clínico</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa fa-medkit"></i> Variáveis Clínicas</span>
                          <div class="count green"><?php echo $caso->v_clinicas_num; ?></div>
                          <span class="count_bottom"><i class="green"></i>Variáveis utilizadas</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa-dollar"></i> Total Gasto</span>
                          <div class="count"><?php echo $caso->valor; ?></div>
                          <span class="count_bottom"><i class="red"></i> reais gastos</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa-user"></i> Status</span>
                          <?php if($caso->ativo){ ?>
                          <div class="count green">Ativo</div>
                          <span class="count_bottom"><i class="green"></i>Em desenvolvimento</span>
                          <?php }else{ ?>
                          <div class="count red">Inativo</div>
                          <span class="count_bottom"><i class="green"></i>Atividade Inativa</span>
                          <?php } ?>
                          
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa-user"></i> Concluído</span>
                          <?php if($caso->concluido){ ?>
                          <div class="count green">SIM</div>
                          <span class="count_bottom"><i class="green"></i> Atividade entregue.</span>
                          <?php }else{ ?>
                          <div class="count red">NÃO</div>
                          <span class="count_bottom"><i class="green"></i> Atividade em andamento</span>
                          <?php } ?>
                        </div>
                      </div>

                      <table class="table table-striped">
                      <thead>
                        <tr>
                          <th></th>
                          <th>SimMed</th>
                          <th><?php echo $caso->usuario; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Diagnóstico</th>
                          <td><?php echo $caso_clinico->diagnostico; ?></td>
                          <td><?php echo $caso->diagnostico; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Prescrição</th>
                          <td><?php echo $caso_clinico->prescricao; ?></td>
                          <td><?php echo $caso->prescricao; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">CID</th>
                          <td><?php echo $caso_clinico->cid; ?></td>
                          <td><?php echo $caso->cid; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Alta</th>
                          <td><?php echo ($caso_clinico->alta) ? 'Sim' : 'Não'; ?></td>
                          <td><?php echo ($caso->alta) ? 'Sim' : 'Não'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Internação</th>
                          <td><?php echo ($caso_clinico->internacao) ? 'Sim' : 'Não'; ?></td>
                          <td><?php echo ($caso->internacao) ? 'Sim' : 'Não'; ?></td>
                        </tr>

                        <tr>
                          <th scope="row">Variáveis Clínicas</th>

                          <td>
                            <?php 

                            foreach($variaveis as $variavel){
                              $ob = ($variavel->obrigatorio) ? '<span style="color:red;">*</span>' : '';
                              echo '<span rel="1" id="vr1_'.$caso->usuario_id.'_'.$variavel->variavel_clinica_id.'">' . $variavel->variavel_clinica . ' ' . $ob . '</span><br />';
                              unset($ob);

                              ?>

                                <script>
                                    $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").mouseover(function() {

                                      var rel = $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("rel");

                                      if(rel == 2){
                                        $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:green;');
                                        $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:green;');
                                      }else{
                                        $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:red;');
                                        $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:red;');
                                      }
                                    }).mouseout(function() {
                                      $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:#73879C;');
                                      $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:#73879C;');
                                    });
                                </script>

                              <?php
                            }

                            ?>
                          </td>
                          <td>
                            <?php 

                            foreach($caso->v_clinicas as $variavel){
                               $ob = ($variavel->obrigatorio) ? '<span style="color:red;">*</span>' : '';
                              echo '<span rel="2" id="vr2_'.$caso->usuario_id.'_'.$variavel->variavel_clinica_id.'">' . $variavel->variavel_clinica . ' ' . $ob . '</span><br />';
                              unset($ob);

                              ?>

                                <script>
                                    $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").mouseover(function() {

                                      var rel = $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("rel");

                                      if(rel == 1){
                                        $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:green;');
                                        $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:green;');
                                      }else{
                                        $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:red;');
                                        $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:red;');
                                      }
                                    }).mouseout(function() {
                                      $("#vr2_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:#73879C;');
                                      $("#vr1_<?php echo $caso->usuario_id; ?>_<?php echo $variavel->variavel_clinica_id; ?>").attr("style", 'color:#73879C;');
                                    });
                                </script>

                              <?php
                            }

                            ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>


                    </div>

                    <?php } ?>


                  </div>
                </div>

              </div>
            </div>

          </div>