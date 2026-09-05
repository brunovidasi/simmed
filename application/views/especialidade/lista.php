<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Especialidade Médica <small>Lista de especialidades médicas</small></h3>
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
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach($especialidades as $especialidade){ ?>
                          <tr>
                            <th scope="row"><?php echo $especialidade->especialidade_medica_id; ?></th>
                            <td><?php echo $especialidade->nome; ?></td>
                            <td align="right">
                              <a href="<?php echo base_url('especialidade/editar/'.$especialidade->especialidade_medica_id); ?>" class="btn btn-xs bg-green">Ver / Editar</a>
                                <a href="<?php echo base_url('especialidade/excluir/'.$especialidade->especialidade_medica_id); ?>" class="btn btn-xs btn-danger">Excluir</a>
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