<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SimMed</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- NProgress -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/assets/gentelella/build'); ?>/css/custom.min.css" rel="stylesheet">

    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jquery/dist/jquery.min.js"></script>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <?php if($this->session->userdata('administrador')){ ?>
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>" class="site_title"><i class="fa fa-stethoscope"></i> <span>SimMed</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <?php if($this->session->userdata('administrador')){ ?>
              <div class="menu_section">

                <h3>Administrador</h3>
                <ul class="nav side-menu">

                  <li class="<?php if($menu == 'usuario') echo 'active'; ?>"><a><i class="fa fa-user"></i> Usuário <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu <?php if($menu == 'usuario') echo 'style="display:block;"'; ?>">
                      <li><a href="<?php echo base_url('/usuario/lista/'); ?>">Lista</a></li>
                      <li><a href="<?php echo base_url('/usuario/cadastrar/'); ?>">Novo</a></li>
                    </ul>
                  </li>

                  <li class="<?php if($menu == 'especialidade') echo 'active'; ?>"><a><i class="fa fa-user-md"></i> Especialidade Médica <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu <?php if($menu == 'usuario') echo 'style="display:block;"'; ?>">
                      <li><a href="<?php echo base_url('/especialidade/lista/'); ?>">Lista</a></li>
                      <li><a href="<?php echo base_url('/especialidade/cadastrar/'); ?>">Novo</a></li>
                    </ul>
                  </li>

                  <li class="<?php if($menu == 'variavel_clinica') echo 'active'; ?>"><a><i class="fa fa-medkit"></i> Variável Clínica <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu <?php if($menu == 'variavel_clinica') echo 'style="display:block;"'; ?>">
                      <li><a href="<?php echo base_url('/variavel_clinica/lista/'); ?>">Lista</a></li>
                      <li><a href="<?php echo base_url('/variavel_clinica/cadastrar/'); ?>">Novo</a></li>
                    </ul>
                  </li>

                  <li class="<?php if($menu == 'caso_clinico') echo 'active'; ?>"><a><i class="fa fa-heartbeat"></i> Caso Clínico <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu <?php if($menu == 'caso_clinico') echo 'style="display:block;"'; ?>">
                      <li><a href="<?php echo base_url('/caso_clinico/lista/'); ?>">Lista</a></li>
                      <li><a href="<?php echo base_url('/caso_clinico/cadastrar/'); ?>">Novo</a></li>
                    </ul>
                  </li>

                </ul>
              </div>
              <?php } ?>
              
              <div class="menu_section">
                <h3>Alunos</h3>
                <ul class="nav side-menu">
                  <li class="<?php if($menu == 'simulador') echo 'active'; ?>"><a><i class="fa fa-heartbeat"></i> Casos Clínicos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu <?php if($menu == 'simulador') echo 'style="display:block;"'; ?>">
                      <?php 
                        $casos = $this->session->userdata('caso_clinicos');
                        foreach($casos as $caso){
                      ?>
                          <li><a href="<?php echo base_url('/simulador/caso/'.$caso->caso_clinico_id); ?>"><?php echo $caso->nome; ?></a></li>
                      <?php 
                        } ?>
                    </ul>
                  </li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Sair" href="<?php echo base_url('/acesso/sair/'); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">

                <li role="presentation" class="dropdown">
                  <a href="<?php echo base_url('/acesso/sair/'); ?>" class="info-number red">
                    <i class="glyphicon glyphicon-off"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <?php } ?>

        <?php if(!$this->session->userdata('administrador')){ ?>
        <style>
            body {
              background: white !important;
            }
            .nav-md .container.body .right_col {
                padding: 10px 20px 0;
                margin-left: 0px !important; 
            }
        </style>
        <?php } ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <?php if(isset($view)) echo $view; ?>

        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            SimMed - Todos os Direitos Reservados
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/nprogress/nprogress.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/Chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/Flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/flot.curvedlines/curvedLines.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/DateJS/build/date.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/switchery/dist/switchery.min.js"></script>

    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/iCheck/icheck.min.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <!-- Select2 -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/starrr/dist/starrr.js"></script>


    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url('/assets/gentelella/vendors'); ?>/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="<?php echo base_url('assets/js/convertermoeda.js'); ?>" type="text/javascript"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('/assets/gentelella'); ?>/build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        $('.moeda').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.'
  });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
      });
    </script>

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Selecione",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 100,
          placeholder: "Selecione",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable( {
        "language": {
            "url": "<?php echo base_url('/assets/gentelella/vendors'); ?>/datatables.net/Portuguese-Brasil.json"
        }
    } );

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->

    <!-- Flot -->
    <script>
      $(document).ready(function() {
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

        //generate random number for charts
        randNum = function() {
          return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        };

        var d1 = [];
        //var d2 = [];

        //here we generate data for chart
        for (var i = 0; i < 30; i++) {
          d1.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
          //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
        }

        var chartMinDate = d1[0][0]; //first day
        var chartMaxDate = d1[20][0]; //last day

        var tickSize = [1, "day"];
        var tformat = "%d/%m/%y";

        //graph options
        var options = {
          grid: {
            show: true,
            aboveData: true,
            color: "#3f3f3f",
            labelMargin: 10,
            axisMargin: 0,
            borderWidth: 0,
            borderColor: null,
            minBorderMargin: 5,
            clickable: true,
            hoverable: true,
            autoHighlight: true,
            mouseActiveRadius: 100
          },
          series: {
            lines: {
              show: true,
              fill: true,
              lineWidth: 2,
              steps: false
            },
            points: {
              show: true,
              radius: 4.5,
              symbol: "circle",
              lineWidth: 3.0
            }
          },
          legend: {
            position: "ne",
            margin: [0, -25],
            noColumns: 0,
            labelBoxBorderColor: null,
            labelFormatter: function(label, series) {
              // just add some space to labes
              return label + '&nbsp;&nbsp;';
            },
            width: 40,
            height: 1
          },
          colors: chartColours,
          shadowSize: 0,
          tooltip: true, //activate tooltip
          tooltipOpts: {
            content: "%s: %y.0",
            xDateFormat: "%d/%m",
            shifts: {
              x: -30,
              y: -50
            },
            defaultTheme: false
          },
          yaxis: {
            min: 0
          },
          xaxis: {
            mode: "time",
            minTickSize: tickSize,
            timeformat: tformat,
            min: chartMinDate,
            max: chartMaxDate
          }
        };
        var plot = $.plot($("#placeholder33x"), [{
          label: "Email Sent",
          data: d1,
          lines: {
            fillColor: "rgba(150, 202, 89, 0.12)"
          }, //#96CA59 rgba(150, 202, 89, 0.42)
          points: {
            fillColor: "#fff"
          }
        }], options);
      });
    </script>
    <!-- /Flot -->

    <!-- jQuery Sparklines -->
    <script>
      $(document).ready(function() {
        $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
          type: 'bar',
          height: '125',
          barWidth: 13,
          colorMap: {
            '7': '#a1a1a1'
          },
          barSpacing: 2,
          barColor: '#26B99A'
        });

        $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
          type: 'bar',
          height: '40',
          barWidth: 8,
          colorMap: {
            '7': '#a1a1a1'
          },
          barSpacing: 2,
          barColor: '#26B99A'
        });

        $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
          type: 'line',
          height: '40',
          width: '200',
          lineColor: '#26B99A',
          fillColor: '#ffffff',
          lineWidth: 3,
          spotColor: '#34495E',
          minSpotColor: '#34495E'
        });
      });
    </script>
    <!-- /jQuery Sparklines -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function() {
        var canvasDoughnut,
            options = {
              legend: false,
              responsive: false
            };

        new Chart(document.getElementById("canvas1i"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });

        new Chart(document.getElementById("canvas1i2"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });

        new Chart(document.getElementById("canvas1i3"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->
    <script type="text/javascript">
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });

      });
    </script>
    <!-- /bootstrap-daterangepicker -->
  </body>
</html>