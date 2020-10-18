<?php
$uri = getenv('REQUEST_URI');
$ehView = true;
include '../control/ValidaSessao.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--eef0e3-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>GestCCon</title>

        <link href="//maxcdn.bootstrapcdn.com" rel="preconnect">
        <link href="//maxcdn.bootstrapcdn.com" rel="dns-prefetch"/>

        <link href="//cdn.datatables.net" rel="preconnect">
        <link href="//cdn.datatables.net" rel="dns-prefetch"/>      

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!--external css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/novo/view/assets/css/zabuto_calendar.css">
        <link rel="stylesheet" type="text/css" href="/novo/view/assets/js/gritter/css/jquery.gritter.css" />
        <link rel="stylesheet" type="text/css" href="/novo/view/assets/lineicons/style.css">    

        <!-- Custom styles for this template -->
        <link href="/novo/view/assets/css/style.css?<?= date('YmdHis'); ?>" rel="stylesheet">
        <link href="/novo/view/assets/css/style-responsive.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

        <link rel="stylesheet" href="/novo/view/css/Resposivo.css?<?= date('YmdHis'); ?>">
        <!--<link rel="stylesheet" href="/novo/css/ModalImage.css?<?= ''//date('YmdHis');          ?>">-->

        <link rel="icon" href="/visao/recursos/img/logo_limpa.png" type="image/x-icon">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <section id="container" >
            <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
            <!--header start-->
            <header class="header black-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <!--logo start-->
                <a href="/novo/" class="logo"><b>GestCCon</b></a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
                        <!-- settings start -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/novo/#">
                                <i class="fa fa-tasks"></i>
                                <span class="badge bg-theme">4</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <div class="notify-arrow notify-arrow-green"></div>
                                <li>
                                    <p class="green">You have 4 pending tasks</p>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <div class="task-info">
                                            <div class="desc">DashGum Admin Panel</div>
                                            <div class="percent">40%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <div class="task-info">
                                            <div class="desc">Database Update</div>
                                            <div class="percent">60%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <div class="task-info">
                                            <div class="desc">Product Development</div>
                                            <div class="percent">80%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <div class="task-info">
                                            <div class="desc">Payments Sent</div>
                                            <div class="percent">70%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                                <span class="sr-only">70% Complete (Important)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- settings end -->
                        <!-- inbox dropdown start-->
                        <li id="header_inbox_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/novo/#">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-theme">5</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-green"></div>
                                <li>
                                    <p class="green">You have 5 new messages</p>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <span class="photo"><img alt="avatar" src="/novo/view/assets/img/ui-zac.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Zac Snider</span>
                                            <span class="time">Just now</span>
                                        </span>
                                        <span class="message">
                                            Hi mate, how is everything?
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <span class="photo"><img alt="avatar" src="/novo/view/assets/img/ui-divya.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Divya Manian</span>
                                            <span class="time">40 mins.</span>
                                        </span>
                                        <span class="message">
                                            Hi, I need your help with this.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <span class="photo"><img alt="avatar" src="/novo/view/assets/img/ui-danro.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Dan Rogers</span>
                                            <span class="time">2 hrs.</span>
                                        </span>
                                        <span class="message">
                                            Love your new Dashboard.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">
                                        <span class="photo"><img alt="avatar" src="/novo/view/assets/img/ui-sherman.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Dj Sherman</span>
                                            <span class="time">4 hrs.</span>
                                        </span>
                                        <span class="message">
                                            Please, answer asap.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/novo/#">See all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox dropdown end -->
                    </ul>
                    <!--  notification end -->
                </div>
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li><a class="logout" href="/novo/sair">Sair</a></li>
                    </ul>
                </div>
            </header>
            <!--header end-->

            <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <a href="/novo/pessoa/<?= $_SESSION["codpessoa"] ?>">
                            <p class="centered">

                                <img src="/sistema/arquivos/<?= $_SESSION["imagem"] ?>" class="img-circle" width="60">

                            </p>
                            <h5 class="centered"><?= $_SESSION['nome'] ?></h5>
                        </a>
                        <li class="mt">
                            <a class="active" href="/novo/">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="/novo/pessoa" >
                                <i class="fa fa-users"></i>
                                <span>Pessoa</span>
                            </a>
                            <!--                            <ul class="sub">
                                                            <li><a  href="general.html">General</a></li>
                                                            <li><a  href="buttons.html">Buttons</a></li>
                                                            <li><a  href="panels.html">Panels</a></li>
                                                        </ul>-->
                        </li>

                        <li class="sub-menu">
                            <a href="/novo/mensagem_morador" >
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>Mens. Morador</span>
                            </a>
                            <!--                            <ul class="sub">
                                                            <li><a  href="calendar.html">Calendar</a></li>
                                                            <li><a  href="gallery.html">Gallery</a></li>
                                                            <li><a  href="todo_list.html">Todo List</a></li>
                                                        </ul>-->
                        </li>


                    </ul>
                    <!-- sidebar menu end-->
                </div> 
            </aside>
            <!--sidebar end-->

            <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <?php
                $uri = getenv('REQUEST_URI');
                $pagina = trim(str_replace('/novo/', '', $uri));
                if (strstr($pagina, '/') != FALSE) {
                    $separa_pagina = explode('/', $pagina);
                    $pagina = $separa_pagina[0];
                    $chavePrimaria = $separa_pagina[1];
                }
                if ($pagina == "pessoa") {

                    include "./pessoa.php";
                } elseif ($pagina == "mensagem_morador") {
                    include "./mensagem.php";
                } else {
                    include './home.php';
                }
                ?>
            </section>

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2011 - <?= date("Y") ?> - GestCCon - Sistema Concierge de Condominios
                    <a href="/novo/#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <script type="text/javascript" src="/novo/view/assets/js/chart-master/Chart.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

        <!-- js placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/novo/view/assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
        <!--common script for all pages-->
        <script type="text/javascript" src="/novo/view/assets/js/common-scripts.js"></script>

        <script type="text/javascript" src="/novo/view/assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="/novo/view/assets/js/gritter-conf.js"></script>

        <!--script for this page-->
        <script type="text/javascript" src="/novo/view/assets/js/sparkline-chart.js"></script>    
        <script type="text/javascript" src="/novo/view/assets/js/zabuto_calendar.js?v1"></script>

        <?php if ($pagina != "") { ?>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>            
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-pt_BR.min.js"></script>
        <?php } ?>        

        <script type="text/javascript" src="/novo/view/js/Geral.js?<?= date('YmdHis'); ?>"></script>

        <?php if (strstr($uri, 'pessoa') != FALSE) { ?>
            <script type="text/javascript" src="/novo/view/js/ajax/Pessoa.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/ObservacaoMorador.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/Atestado.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/Arquivo.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/Bicicleta.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/Comunicado.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/Telefone.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/ajax/Veiculo.js?<?= date('YmdHis'); ?>"></script>

            <?php
            if (isset($chavePrimaria) && $chavePrimaria > 0) {
                ?>
                <script>
                    procurarObjeto({tabela: 'pessoa', campo: 'codpessoa', codigo: '<?= $chavePrimaria ?>'}, setarLinhaPessoa)</script>
                <?php
            }
        }
        ?>        

        <?php if (strstr($uri, 'mensagem') != FALSE) { ?>
            <script type="text/javascript" src="/novo/view/js/ajax/Mensagem.js?<?= date('YmdHis'); ?>"></script>
            <script type="text/javascript" src="/novo/view/js/tinymce/tinymce.min.js?v=13"></script>
            <script type="text/javascript" src="/novo/view/js/Editor.js?<?= date('YmdHis'); ?>"></script>            
        <?php } ?>        

        <script type="text/javascript">
            $(document).ready(function () {
                $("#date-popover").popover({html: true, trigger: "manual"});
                $("#date-popover").hide();
                $("#date-popover").click(function (e) {
                    $(this).hide();
                });

                $("#my-calendar").zabuto_calendar({
                    action: function () {
                        return myDateFunction(this.id, false);
                    },
                    action_nav: function () {
                        return myNavFunction(this.id);
                    },
                    ajax: {
                        url: "show_data.php?action=1",
                        modal: true
                    },
                    legend: [
                        {type: "text", label: "Evento especial", badge: "00"},
                        {type: "block", label: "Evento regular", }
                    ]
                });
            });


            function myNavFunction(id) {
                $("#date-popover").hide();
                var nav = $("#" + id).data("navigation");
                var to = $("#" + id).data("to");
                console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
            }

            var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
            var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(serverstatus02);

        </script>


    </body>
</html>