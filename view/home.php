<?php
    $sql = "select count(1) as qtd from pessoa where status = 'a' and codnivel in(select codnivel from nivel where codempresa = {$_SESSION["codempresa"]} and nome = 'Morador')";
    $totalMorador = $conexao->comandoArray($sql);
    
    $sql = "select count(1) as qtd from noticia where codempresa = {$_SESSION["codempresa"]}";
    $totalNoticia = $conexao->comandoArray($sql);
    
    $sql = "select count(1) as qtd from correspondencia where codempresa = {$_SESSION["codempresa"]} and codstatus = 2";
    $totalCorrespondencia = $conexao->comandoArray($sql);
    
    $sql = "select count(1) as qtd from reserva where codempresa = {$_SESSION["codempresa"]} and data >= '".date("Y-m-d")."'";
    $totalReserva = $conexao->comandoArray($sql);
?>
<section class="wrapper">

    <div class="row">
        <div class="col-lg-9 main-chart">

            <div class="row mtbox">
                <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                    <div class="box1">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <h3><?=$totalMorador["qtd"]?></h3>
                    </div>
                    <p><?=$totalMorador["qtd"]?> moradores cadastrados e ativos</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <h3><?=$totalCorrespondencia["qtd"]?></h3>
                    </div>
                    <p><?=$totalCorrespondencia["qtd"]?> correspondências não entregues</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <span class="li_stack"></span>
                        <h3>23</h3>
                    </div>
                    <p>You have 23 unread messages in your inbox.</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <span class="li_news"></span>
                        <h3><?=$totalNoticia["qtd"]?></h3>
                    </div>
                    <p><?=$totalNoticia["qtd"]?> noticias cadastradas no portal de moradores</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <h3><?=$totalReserva["qtd"]?></h3>
                    </div>
                    <p><?=$totalReserva["qtd"]?> reservas futuras feitas</p>
                </div>

            </div><!-- /row mt -->	


            <div class="row mt">
                <!-- SERVER STATUS PANELS -->
                <div class="col-md-4 col-sm-4 mb">
                    <div class="white-panel pn donut-chart">
                        <div class="white-header">
                            <h5>SERVER LOAD</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 goleft">
                                <p><i class="fa fa-database"></i> 70%</p>
                            </div>
                        </div>
                        <canvas id="serverstatus01" height="120" width="120"></canvas>
                        <script>
                            var doughnutData = [
                                {
                                    value: 70,
                                    color: "#68dff0"
                                },
                                {
                                    value: 30,
                                    color: "#fdfdfd"
                                }
                            ];
                        </script>
                    </div><! --/grey-panel -->
                </div><!-- /col-md-4-->


                <div class="col-md-4 col-sm-4 mb">
                    <div class="white-panel pn">
                        <div class="white-header">
                            <h5>TOP PRODUCT</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 goleft">
                                <p><i class="fa fa-heart"></i> 122</p>
                            </div>
                            <div class="col-sm-6 col-xs-6"></div>
                        </div>
                        <div class="centered">
                            <img src="/novo/view/assets/img/product.png" width="120">
                        </div>
                    </div>
                </div><!-- /col-md-4 -->

                <div class="col-md-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <div class="white-panel pn">
                        <div class="white-header">
                            <h5>TOP USER</h5>
                        </div>
                        <p><img src="/novo/view/assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
                        <p><b>Zac Snider</b></p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="small mt">MEMBER SINCE</p>
                                <p>2012</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small mt">TOTAL SPEND</p>
                                <p>$ 47,60</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /col-md-4 -->


            </div><!-- /row -->


            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-md-4 mb">
                    <div class="darkblue-panel pn">
                        <div class="darkblue-header">
                            <h5>DROPBOX STATICS</h5>
                        </div>
                        <canvas id="serverstatus02" height="120" width="120"></canvas>
                        <script>
                            var serverstatus02 = [
                                {
                                    value: 60,
                                    color: "#68dff0"
                                },
                                {
                                    value: 40,
                                    color: "#444c57"
                                }
                            ];
                        </script>
                        <p>April 17, 2014</p>
                        <footer>
                            <div class="pull-left">
                                <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
                            </div>
                            <div class="pull-right">
                                <h5>60% Used</h5>
                            </div>
                        </footer>
                    </div><! -- /darkblue panel -->
                </div><!-- /col-md-4 -->


                <div class="col-md-4 mb">
                    <!-- INSTAGRAM PANEL -->
                    <div class="instagram-panel pn">
                        <i class="fa fa-instagram fa-4x"></i>
                        <p>@THISISYOU<br/>
                            5 min. ago
                        </p>
                        <p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
                    </div>
                </div><!-- /col-md-4 -->

                <div class="col-md-4 col-sm-4 mb">
                    <!-- REVENUE PANEL -->
                    <div class="darkblue-panel pn">
                        <div class="darkblue-header">
                            <h5>REVENUE</h5>
                        </div>
                        <div class="chart mt">
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                        </div>
                        <p class="mt"><b>$ 17,980</b><br/>Month Income</p>
                    </div>
                </div><!-- /col-md-4 -->

            </div><!-- /row -->

            <div class="row mt">
                <!--CUSTOM CHART START -->
                <div class="border-head">
                    <h3>VISITS</h3>
                </div>
                <div class="custom-bar-chart">
                    <ul class="y-axis">
                        <li><span>10.000</span></li>
                        <li><span>8.000</span></li>
                        <li><span>6.000</span></li>
                        <li><span>4.000</span></li>
                        <li><span>2.000</span></li>
                        <li><span>0</span></li>
                    </ul>
                    <div class="bar">
                        <div class="title">JAN</div>
                        <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">FEB</div>
                        <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">MAR</div>
                        <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">APR</div>
                        <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                    </div>
                    <div class="bar">
                        <div class="title">MAY</div>
                        <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">JUN</div>
                        <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                    </div>
                    <div class="bar">
                        <div class="title">JUL</div>
                        <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                    </div>
                </div>
                <!--custom chart end-->
            </div><!-- /row -->	

        </div><!-- /col-lg-9 END SECTION MIDDLE -->


        <!-- **********************************************************************************************************************************************************
        RIGHT SIDEBAR CONTENT
        *********************************************************************************************************************************************************** -->                  

        <div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
            <h3>NOTIFICAÇÕES</h3>

            <!-- First Action -->
            <div class="desc">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="details">
                    <p><muted>2 Minutes Ago</muted><br/>
                    <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                    </p>
                </div>
            </div>
            <!-- Second Action -->
            <div class="desc">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="details">
                    <p><muted>3 Hours Ago</muted><br/>
                    <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                    </p>
                </div>
            </div>
            <!-- Third Action -->
            <div class="desc">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="details">
                    <p><muted>7 Hours Ago</muted><br/>
                    <a href="#">Brandon Page</a> purchased a year subscription.<br/>
                    </p>
                </div>
            </div>
            <!-- Fourth Action -->
            <div class="desc">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="details">
                    <p><muted>11 Hours Ago</muted><br/>
                    <a href="#">Mark Twain</a> commented your post.<br/>
                    </p>
                </div>
            </div>
            <!-- Fifth Action -->
            <div class="desc">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="details">
                    <p><muted>18 Hours Ago</muted><br/>
                    <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
                    </p>
                </div>
            </div>

            <!-- USERS ONLINE SECTION -->
            <h3>FUNCIONÁRIOS CONDOMINIO</h3>
            <!-- First Member -->
            <div id="teamMembers">
                <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
                
                *** Carregando
            </div>


            <!-- CALENDAR-->
            <div id="calendar" class="mb">
                <div class="panel green-panel no-margin">
                    <div class="panel-body">
                        <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                            <div class="arrow"></div>
                            <h3 class="popover-title" style="disadding: none;"></h3>
                            <div id="date-popover-content" class="popover-content"></div>
                        </div>
                        <div id="my-calendar"></div>
                    </div>
                </div>
            </div><!-- / calendar -->

        </div><!-- /col-lg-3 -->
    </div>
</section>
