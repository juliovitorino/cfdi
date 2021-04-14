<?php  
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Console Administrativo do Linker" />
    <meta name="author" content="Julio Cesar Vitorno" />
    <title>Console Administrativo do Linker</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="../assets/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- sweet alert -->
    <link rel="stylesheet" href="../assets/sweet-alert/sweetalert.min.css">
    <!-- data tables -->
    <link href="../assets/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="../assets/material/material.min.css">
    <link rel="stylesheet" href="css/material_style.css">
    <!-- Date Time item CSS -->
    <link rel="stylesheet" href="../assets//material-datetimepicker/bootstrap-material-datetimepicker.css" />

    <!-- Theme Styles -->
    <link href="css/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/theme-color.css" rel="stylesheet" type="text/css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" /> 
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="index.html">
                    <span class="logo-icon fa fa-stethoscope fa-rotate-45"></span>
                    <span class="logo-default">LINKER</span> </a>
                </div>
                <!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
                 <form class="search-form-opened" action="#" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="query">
                        <span class="input-group-btn">
                          <a href="javascript:;" class="btn submit">
                             <i class="icon-magnifier"></i>
                           </a>
                        </span>
                    </div>
                </form>
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
               <!-- end mobile menu -->
                <!-- start header menu -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                    	<!-- start language menu -->
                        <li class="dropdown language-switch">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="img/flags/br.png" class="position-left" alt=""> Português <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="portuguese"><img src="img/flags/br.png" alt=""> Português</a>
                                </li>
                                <li>
                                    <a class="english"><img src="img/flags/gb.png" alt=""> English</a>
                                </li>
                                <li>
                                    <a class="espana"><img src="img/flags/es.png" alt=""> España</a>
                                </li>
                            </ul>
                        </li>
                        <!-- end language menu -->

                        <!-- start notification dropdown -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge headerBadgeColor1"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3><span class="bold">Notificações</span></h3>
                                    <span class="notification-label purple-bgcolor"></span>
                                </li>
                                <li>
                                    <ul id="lista-notificacao" class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">

                                        <!-- notificações dinamicas -->

                                    </ul>
                                    <div class="dropdown-menu-footer">
                                        <a href="javascript:void(0)"> Todas as Notificações </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- end notification dropdown -->
                        <!-- start message dropdown -->
 						<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge headerBadgeColor2"> 2 </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3><span class="bold">Messages</span></h3>
                                    <span class="notification-label cyan-bgcolor">New 2</span>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                	<img src="img/doc/doc2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                	<span class="from"> Sarah Smith </span>
                                                	<span class="time">Just Now </span>
                                                </span>
                                                <span class="message"> Jatin I found you on LinkedIn... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                	<img src="img/doc/doc3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                	<span class="from"> John Deo </span>
                                                	<span class="time">16 mins </span>
                                                </span>
                                                <span class="message"> Fwd: Important Notice Regarding Your Domain Name... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                	<img src="img/doc/doc1.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                	<span class="from"> Rajesh </span>
                                                	<span class="time">2 hrs </span>
                                                </span>
                                                <span class="message"> pls take a print of attachments. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                	<img src="img/doc/doc8.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                	<span class="from"> Lina Smith </span>
                                                	<span class="time">40 mins </span>
                                                </span>
                                                <span class="message"> Apply for Ortho Surgeon </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                	<img src="img/doc/doc5.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                	<span class="from"> Jacob Ryan </span>
                                                	<span class="time">46 mins </span>
                                                </span>
                                                <span class="message"> Request for leave application. </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-menu-footer">
                                        <a href="#"> All Messages </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- end message dropdown -->
 						<!-- start manage user dropdown -->
 						<li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle " src="img/dp.jpg" />
                                <span class="username username-hide-on-mobile id-usuario"></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="user_profile.html">
                                        <i class="icon-user"></i> Perfil </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-settings"></i> Configuração
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-directions"></i> Ajuda
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="lock_screen.html">
                                        <i class="icon-lock"></i> Bloquear Tela
                                    </a>
                                </li>
                                <li>
                                    <a href="login.html">
                                        <i class="icon-logout"></i> Sair </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end manage user dropdown -->
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                             <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
	                           <i class="material-icons">more_vert</i>
	                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end header -->

        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 			<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll" class="left-sidemenu">
	                    <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                            <!-- JCV - Sidebar esquerda Dashboard -->
                            <li class="sidebar-user-panel">
                                <div class="user-panel">
                                    <div class="pull-left image">
                                        <img src="img/dp.jpg" class="img-circle user-img-circle" alt="User Image" />
                                    </div>
                                    <div class="pull-left info">
                                        <p class="id-usuario"></p>
                                        <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
                                    </div>
                                </div>
                            </li>

                            <!-- JCV - Sidebar esquerda Configuração Geral (settings) -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-cogs"></i>
                                <span class="title">Configuração</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="index.php?target=all_projetos&lt=true&o=projetos" class="nav-link"> <span class="title">Projetos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.php?target=all_campanhas" class="nav-link"> <span class="title">Campanha</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"> <span class="title">Promoção</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Acompanhar -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-tags"></i>
                                <span class="title">Acompanhar</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"> <span class="title">Campanha</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <!-- JCV - Sidebar esquerda Headlines -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-bullhorn"></i>
                                <span class="title">Headlines</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="index.php?target=headlines" class="nav-link"> <span class="title">Headline Builder</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                           
                            <!-- JCV - Sidebar esquerda Artigo de Venda Minisite -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-money"></i>
                                <span class="title">Artigo Minisite</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="index.php?target=tbuilder&lt=true&o=projetos" class="nav-link"> <span class="title">Template Builder</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Backlinks -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-link"></i>
                                <span class="title">Backlinks</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="index.php?target=bcklnknofollow" class="nav-link"> <span class="title">No Follow</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Menu Youtube SEO -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-bolt"></i>
                                <span class="title">SEO Studio</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="index.php?target=seostudio-builder&lt=true&o=projetos" class="nav-link"> <span class="title">Builder</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                           
                            <!-- JCV - Sidebar esquerda Menu Posts Redes Sociais -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-facebook"></i>
                                <span class="title">Posts Redes Sociais</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="index.php?target=posts-facebook" class="nav-link"> <span class="title">Facebook</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="index.php?target=posts-instagram" class="nav-link"><span class="title">Instagram</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="book_appointment_material.html" class="nav-link "> <span class="title">Pinterest</span>
                                        </a>
                                    </li>
                                     <li class="nav-item  ">
                                        <a href="edit_appointment.html" class="nav-link "> <span class="title">WhatsApp</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="view_appointment.html" class="nav-link "> <span class="title">Google+</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Engajamento Social -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-anchor"></i>
                                <span class="title">Engajamento Social</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="index.php?target=engajamento-social-facebook" class="nav-link"> <span class="title">Facebook</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="index.php?target=posts-instagram" class="nav-link"><span class="title">Instagram</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="book_appointment_material.html" class="nav-link "> <span class="title">Pinterest</span>
                                        </a>
                                    </li>
                                     <li class="nav-item  ">
                                        <a href="edit_appointment.html" class="nav-link "> <span class="title">WhatsApp</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="view_appointment.html" class="nav-link "> <span class="title">Google+</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Menu Nutrir Fortaleza Web 2.0 -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-bomb"></i>
                                <span class="title">Web 2.0</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="index.php?target=web20builder&lt=true&o=projetos" class="nav-link"> <span class="title">Web 2.0 Builder</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Menu Nutrir Fortaleza PBN -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-rocket"></i>
                                <span class="title">PBN</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="index.php?target=pbnbuilder&lt=true&o=projetos" class="nav-link"> <span class="title">PBN Builder</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- JCV - Sidebar esquerda Menu Ads -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-magic"></i>
                                <span class="title">Ads</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="index.php?target=facebook-ads" class="nav-link"> <span class="title">Facebook Ads</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="index.php?target=google-ads" class="nav-link"><span class="title">Google Ad Word</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <!-- JCV - Sidebar esquerda Campanha de Emails -->
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"><i class="fa fa-envelope"></i>
                                <span class="title">Funil de Emails</span><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="schedule.html" class="nav-link"> <span class="title">Curta 3x1</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="schedule.html" class="nav-link"> <span class="title">Média 5x2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="schedule.html" class="nav-link"> <span class="title">Longa 7x3</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu --> 

            <!-- snippet de codigo dinamico jcv ex: snippet-dashboard-startup.html-->
            <span id="snippet-code-jcv"></span>

            <!-- ******************************************************** --> 
            <!-- PHP inline para conteúdo dinâmico e manter o DOM intacto -->
            <!-- ******************************************************** --> 
            <?php  
                session_start();

                // Importa pacotes necessários
                require_once '../php/classes/composite/TemplateLoader.php';

                // Obtem o pacote enviado via post do JQuery
                $target = $_GET['target'];

                if ($target === ''){
                    $target = 'dashboard-startup';
                }

                $template = new TemplateLoader(getcwd().'/snippets/'.$target.'.html');
                echo $template->getConteudo();
            ?>
            <!-- ******************************************************** --> 
            <!-- PHP inline para conteúdo dinâmico e manter o DOM intacto -->
            <!-- ******************************************************** --> 

        </div>
        <!-- end page container -->

        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy; Papaléguas do Marketing Digital :: Julio Vitorino Theme By
            <a href="mailto:redstartheme@gmail.com" target="_top" class="makerCss">RT Theme maker</a>
            <div id="testejcv"></div>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- end footer -->
    </div>

    <!-- start js include path -->
    <script src="../assets/jquery.min.js" ></script>
    <script src="../assets/popper/popper.js" ></script>
    <script src="../assets/jquery.blockui.min.js" ></script>
    <script src="../assets/jquery.slimscroll.js"></script>
    <!-- bootstrap -->
    <script src="../assets/bootstrap/js/bootstrap.min.js" ></script>
    <script src="../assets/bootstrap-switch/js/bootstrap-switch.min.js" ></script>
    <!-- counterup -->
    <script src="../assets/counterup/jquery.waypoints.min.js" ></script>
    <script src="../assets/counterup/jquery.counterup.min.js" ></script>
    <!-- Common js-->
    <script src="../assets/app.js" ></script>
    <script src="../assets/layout.js" ></script>
    <script src="../assets/theme-color.js" ></script>
    <!-- Material -->
    <script src="../assets/material/material.min.js"></script>
    <script src="../assets/material-datetimepicker/moment-with-locales.min.js"></script>
    <script src="../assets/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="../assets/material-datetimepicker/datetimepicker.js"></script>
    <!-- chart js -->
    <script src="../assets/chart-js/Chart.bundle.js" ></script>
    <script src="../assets/chart-js/utils.js" ></script>
    <script src="../assets/chart-js/home-data.js" ></script>

<!-- dados dinamicos para o grafico TESTE
    <script src="../assets/chart-js/chartjs-data.js" ></script>
-->
    
    <!-- Sweet Alert -->
    <script src="../assets/sweet-alert/sweetalert.min.js" ></script>
    <script src="../assets/sweet-alert/sweet-alert-data.js" ></script>
    <!-- data tables -->
    <script src="../assets/datatables/jquery.dataTables.min.js" ></script>
    <script src="../assets/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js" ></script>

    <!-- gcjcv js -->
    <script src="../js/gcjcv.js" ></script>

    <!-- ************************************************************************************ --> 
    <!-- PHP inline para js dinâmico para evitar sobrecarga do browser e manter o DOM intacto -->
    <!-- ************************************************************************************ --> 
    <?php  
        // Importa pacotes necessários
        require_once '../php/classes/composite/TemplateLoader.php';

        // Obtem o pacote enviado via post do JQuery sob demanda
        $target = $_GET['target'];

        if($target == "all_campanhas") {
            $template = new TemplateLoader(getcwd().'/../incjs/campanha_table_data.inc');
            echo $template->getConteudo();
        } else if($target == "add_campanha") {
            $template = new TemplateLoader(getcwd().'/../incjs/add_campanha.inc');
            echo $template->getConteudo();
        } else if(
            ($target == "all_projetos") || ($target == "add_projeto") ||($target == "edit_projeto") 
        ) {
                $template = new TemplateLoader(getcwd().'/../incjs/gcjcv_projeto_table_data.inc');
                echo $template->getConteudo();

        } else if( 	($target == "tbuilder") || 
        			($target == "web20builder") ||
                    ($target == "pbnbuilder")) {
                $template = new TemplateLoader(getcwd().'/../incjs/gcjcv_projeto_list.inc');
                echo $template->getConteudo();
        } else if( $target == "dashboard-startup")  {
                $template = new TemplateLoader(getcwd().'/../incjs/gcjcv_dashboard.inc');
                echo $template->getConteudo();
        } else if( $target == "bcklnknofollow")  {
                $template = new TemplateLoader(getcwd().'/../incjs/gcjcv_bcklnknofollow.inc');
                echo $template->getConteudo();
        } else if(  $target == "seostudio-builder") {
                $template = new TemplateLoader(getcwd().'/../incjs/gcjcv_projeto_list.inc');
                echo $template->getConteudo();
                $template = new TemplateLoader(getcwd().'/../incjs/gcjcv_keyword_list.inc');
                echo $template->getConteudo();

        }
    ?>
    <!-- end js include path -->
  </body>
</html>

<?php  
ob_end_flush();
?>

