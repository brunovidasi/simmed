<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Caso Clínico X</h3>
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

            <!-- <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> <?php echo $usuario->login; ?></span>
              <div class="count"><?php echo $qtd_casos_clinicos; ?></div>
              <span class="count_bottom"><i class="green"></i> casos clínicos</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Tempo de Execução</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"></i>Desde <?php echo fdatetime($caso_clinico_usuario->data_cadastro, '/'); ?></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa fa-medkit"></i> Variáveis Clínicas</span>
              <div class="count green">10</div>
              <span class="count_bottom"><i class="green"></i>Variáveis utilizadas</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-dollar"></i> Total Gasto</span>
              <div class="count">10</div>
              <span class="count_bottom"><i class="red"></i> reais gastos</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Status</span>
              <div class="count green">Ativo</div>
              <span class="count_bottom"><i class="green"></i>Em desenvolvimento</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Concluído</span>
              <div class="count red">NÃO</div>
              <span class="count_bottom"><i class="green"></i> <a href="">Clique para concluir</a></span>
            </div>
          </div> -->

          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Variáveis clínicas <small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Solicitação de variável clínica:</a>
                                          </h2> <br />

                            <form class="form-horizontal form-label-left">

                              <div class="vr_box">

                                <div class="form-group">
                                  <div class="col-md-10 col-sm-10 col-xs-10">
                                    <select class="select2_single form-control" name="variavel_clinica" tabindex="-1">
                                      <option></option>
                                      <?php foreach($variavel_clinicas as $variavel_clinica){ ?>
                                        <option value="<?php echo $variavel_clinica->variavel_clinica_id; ?>" rel="1"><?php echo $variavel_clinica->nome; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="col-md-2 col-sm-2 col-xs-2">
                                    <span class="btn btn-success" id="add_variavel_clinica" >Pedir</span>
                                  </div>
                                </div>

                              </div>

                            </form>


                            <script>
                              $(document).ready(function() {
                                
                                $('#add_variavel_clinica').click(function(){

                                  var variavel_clinica_id = $('select[name=variavel_clinica]').val();

                                  // $('select[name=variavel_clinica] option[value='+variavel_clinica_id+']').attr('rel', 0);
                                  // $('select[name=variavel_clinica] option[value='+variavel_clinica_id+']').attr('disabled', 'disabled');
                                  
                                  $('select[name=variavel_clinica] option[value='+variavel_clinica_id+']').remove();

                                  $.post("<?php print base_url('simulador/variavel_clinica/'.$caso_clinico->caso_clinico_id); ?>", {variavel_clinica_id:variavel_clinica_id}, function(valor){
                                    $('#prepend').append(valor);
                                  });

                                });

                              });
                            </script>

                          </div>
                        </div>
                      </li>


                      <?php foreach($variavel_clinica_pedidas as $vp){ ?>

                        <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                              <a><?php echo $vp->nome; ?></a>
                            </h2>
                            <p class="excerpt"><?php echo (!empty($vp->texto)) ? $vp->texto : 'Dado não disponível.'; ?></a>
                            </p>
                          </div>
                        </div>
                        </li>

                        <script>
                            $(document).ready(function() {
                              
                              var variavel_clinica_id = <?php echo (int) $vp->variavel_clinica_id; ?>

                              // $('select[name=variavel_clinica] option[value='+variavel_clinica_id+']').attr('rel', 0);
                              // $('select[name=variavel_clinica] option[value='+variavel_clinica_id+']').attr('disabled', 'disabled');

                              $('select[name=variavel_clinica] option[value='+variavel_clinica_id+']').remove();

                            });
                          </script>

                      <?php } ?>

                      <div id="prepend"></div>

                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <form method="post" action="<?php echo base_url('simulador/encerrar_caso/'.$caso_clinico->caso_clinico_id); ?>">

            <div class="col-md-5 col-sm-12 col-xs-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Diagnóstico<small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div id="alerts"></div>

                  <textarea name="diagnostico" id="diagnostico" class="form-control" rows="10"></textarea>
                  
                  <br />

                  <div class="ln_solid"></div>

                </div>
              </div>
            </div>

            <div class="col-md-5 col-sm-12 col-xs-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Prescrição<small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div id="alerts"></div>

                  <textarea name="prescricao" id="prescricao" class="form-control" rows="10"></textarea>
                  
                  <br />

                  <div class="ln_solid"></div>

                </div>
              </div>
            </div>

            <div class="col-md-2 col-sm-12 col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12">CID:</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="cid" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12">Dar alta:</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="checkbox" name="alta" class="js-switch" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12">Internar Paciente:</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="checkbox" name="internacao" class="js-switch" />
                    </div>
                  </div>
                  
            </div>

            <button type="submit" class="btn btn-success btn-lg col-md-12">ENCERRAR CASO CLÍNICO</button>

            </form>


          </div>
          </div>


<!-- bootstrap-wysiwyg -->
    <script>
      $(document).ready(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
          fileUploadError: showErrorAlert
        });

        window.prettyPrint;
        prettyPrint();
      });
    </script>
    <!-- /bootstrap-wysiwyg -->