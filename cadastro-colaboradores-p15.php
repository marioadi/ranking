<?php session_start(); 
require 'class/usuario.class.php';
require 'class/colaboradores.class.php';
$usuario = new Usuario();
$colab = new Colaboradores();

if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user']) ) {
    $usuario->loginAuth($_SESSION['id_user']);
}else{
  header("Location: index.php");
  exit;
}

if(isset($_GET['deslogar'])){
  $usuario->logout();
  header("Location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C&A Ranking | Cadastro P15</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- My style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>C&A </b>Ranking</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $usuario->getNome(); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
                <p>
                  Associado(a) <?php echo $usuario->getNome(); ?>
                  <small>Membro</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
               /.row -->
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="sair.php" class="btn btn-default btn-flat">Deslogar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuario->getNome(); ?></p>
          <a href="#"><i class="fa fa-circle" style="color:#7fff00;"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- INICIO MENU -->
      <?php include ('menu.php'); ?>
      <!-- FIM MENU -->

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cadastro P15</li>
      </ol>
    </section>
    <?php

      if(isset($_POST['nome-cad']) && !empty($_POST['nome-cad'])){
          $colab->addColabP15($_POST['nome-cad'], $_POST['valor-cad']);
      }

    ?>
    <!-- Main content -->
      <section class="content">
        <div class="content mt-3">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dados do Colaborador - PTC</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="POST" style="display: flex;">
                         <div class="container">
                            <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                  <div  class="form-group espaco-topo">
                                      <div class="col-xs-12 col-sm-4">
                                          <label class="control-label">Nome</label>
                                          <input class="form-control" type="text" name="nome-cad" >
                                      </div>
                                      <div class="col-xs-12 col-sm-4">
                                          <label class="control-label">Valor</label>
                                          <input class="form-control" type="text" name="valor-cad" >
                                      </div>
                                  </div>
                              </div>
							               
                              <div class="col-sm-12">
                							  <div class="painel-botoes">
                									<a href="painel-p15.php" class="btn btn-primary">
                									  <i class="fa fa-angle-double-left"></i>
                									  <span>Voltar</span>
                									</a>
                									<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Cadastrar</button>  
                							  </div>
                							</div> 
                             </div>   
                        </div>
                  </form>
                  </div>             
                </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b> 1.0 By <b> Mj_Dev</b>
    </div>
    <strong>&copy; Larissa V. - 2019</strong>
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->

</body>
</html>

