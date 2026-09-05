<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Casos Clínicos <small>Lista de casos clínicos</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <table class="table" id="datatable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nome</th>
                          <th>Área Principal</th>
                          <th>Conclusão</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach($caso_clinicos as $caso_clinico){ ?>

                          <tr>
                          <td><?php echo $caso_clinico->numero; ?></td>
                          <td>
                            <a href="<?php echo base_url('caso_clinico/editar/'.$caso_clinico->caso_clinico_id); ?>"><?php echo $caso_clinico->nome; ?></a>
                            <br>
                            <small>Criado em <?php echo fdatetime($caso_clinico->data_cadastro, '/'); ?></small>
                          </td>

                          <td>
                            <a><?php echo $caso_clinico->area_principal; ?></a>
                            <br>
                            <small><?php echo $caso_clinico->area_secundaria; ?></small>
                          </td>

                          <?php
                            $concluidos = explode(",", $caso_clinico->concluido);

                            $total_projetos = count($concluidos);
                            $projetos_concluidos = 0;

                            foreach($concluidos as $concluido)
                              if($concluido == 1)
                                $projetos_concluidos++;

                            // quantos = por
                            $v1 = 100; /* = */ $v2 = $total_projetos;
                            //            X
                            // quantos? = pagando
                            $v3 = ""; /* = */ $v4 = $projetos_concluidos;

                            $c1 = $v1*$v4;
                            $c2 = $v2;
                            $total = $c1/$c2;

                          ?>

                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $total; ?>" aria-valuenow="<?php echo $total-1; ?>" style="width: <?php echo $total; ?>%;"></div>
                            </div>
                            <small><?php echo $total; ?>% completo (<?php echo $total_projetos; ?> grupos, <?php echo $projetos_concluidos; ?> concluídos)</small>
                          </td>
                          <td align="right">
                            <a href="<?php echo base_url('caso_clinico/editar/'.$caso_clinico->caso_clinico_id); ?>" class="btn btn-xs bg-green"><i class="fa fa-folder"></i> Ver / Editar</a>
                            <a href="<?php echo base_url('caso_clinico/excluir/'.$caso_clinico->caso_clinico_id); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Excluir</a>
                            
                          </td>
                        </tr>

                        <?php } ?>

                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>

            </div>
          </div>