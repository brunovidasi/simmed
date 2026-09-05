<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Usuários <small>Lista de usuários do sistema</small></h3>
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
                          <th>Login</th>
                          <th>Administrador</th>
                          <th>Status</th>
                          <th>Cadastro</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach($usuarios as $usuario){ ?>
                          <tr>
                            <th scope="row"><?php echo $usuario->usuario_id; ?></th>
                            <td><?php echo $usuario->login; ?></td>
                            <td>
                                <?php if($usuario->administrador == '1'){ ?>
                                  <span class="badge bg-green">Sim</span>
                                <?php }else{ ?>
                                  <span class="badge bg-red">Não</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($usuario->ativo == '1'){ ?>
                                  <span class="badge bg-green">Ativo</span>
                                <?php }else{ ?>
                                  <span class="badge bg-red">Inativo</span>
                                <?php } ?>
                            </td>
                            <td><?php echo fdatetime($usuario->data_cadastro, "/"); ?></td>

                            <td align="right">
                              <a href="<?php echo base_url('usuario/editar/'.$usuario->usuario_id); ?>" class="btn btn-xs bg-green">Ver / Editar</a>
                              <?php if($usuario->usuario_id != '1'){ ?>
                              <?php if($usuario->ativo == '1'){ ?>
                                <a href="<?php echo base_url('usuario/excluir/'.$usuario->usuario_id); ?>" class="btn btn-xs btn-danger">Desativar</a>
                              <?php }else{ ?>
                                <a href="<?php echo base_url('usuario/excluir/'.$usuario->usuario_id.'/1'); ?>" class="btn btn-xs btn-success">Ativar</a>
                              <?php } ?>
                              <?php } ?>
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