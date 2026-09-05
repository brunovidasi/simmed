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
                          <th>Número</th>
                          <th>Área Principal</th>
                          <th>Data Cadastro</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach($caso_clinicos as $caso_clinico){ ?>
                          <tr>
                            <th scope="row"><?php echo $caso_clinico->caso_clinico_id; ?></th>
                            <td><?php echo $caso_clinico->nome; ?></td>
                            <td><?php echo $caso_clinico->numero; ?></td>
                            <td><?php echo $caso_clinico->area_principal; ?></td>
                            <td><?php echo $caso_clinico->data_cadastro; ?></td>
                            <td align="right">
                              <a href="<?php echo base_url('caso_clinico/editar/'.$caso_clinico->caso_clinico_id); ?>" class="btn btn-xs bg-green">Ver / Editar</a>
                                <a href="<?php echo base_url('caso_clinico/excluir/'.$caso_clinico->caso_clinico_id); ?>" class="btn btn-xs btn-danger">Excluir</a>
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