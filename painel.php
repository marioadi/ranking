<?php 
require 'conexao.php';
session_start();
require 'usuario.class.php';
require 'colaboradores.class.php';
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

if(isset($_POST['id_colab'])){
  $colab->removeColabPcj($_POST['id_colab']);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C&A Ranking | Painel PCJ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
   <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="bower_components/morris.js/morris.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
                  <a href="?deslogar" class="btn btn-default btn-flat">Deslogar</a>
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
        <li class="active">Painel PCJ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <!-- Main row -->
      <div class="row">
        <section class="col-sm-12 connectedSortable">
        <!-- Inicio Conteudo -->

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de colaborades cadastrados - PCJ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Valor</th>
		  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $sql = $colab->listAllPcj();
                  if($sql->rowCount() > 0){
                    foreach ($sql->fetchAll() as $ln) {
                      $ln = $colab->colabAuthPcj($ln['id']);    
                ?>
                    <tr>
		     <td><?php echo $ln['id']; ?></td>
                      <td><?php echo $ln['nome']; ?></td>
			<?php $resultado = number_format($ln['resultado'], 2, ',', '.'); ?>
                      <td>R$ <?php echo $resultado; ?></td>
                      <td style=" width: 100px;">
			<form method="POST" style="float: left; margin-right: 5px;">
                            <input type="hidden" name="id_colab" value="<?php echo $ln['id']; ?>">

                            <button class="btn btn-danger" style="border-radius: 20px;" type="submit"><span class="fa fa-remove"></span></button>
                        </form>
                        <form action="editar-colaborador.php" method="POST" style="float: left;">
                            <input type="hidden" name="id-panel" value="<?php echo $ln['id']; ?>">
                            <input type="hidden" name="nome-panel" value="<?php echo $ln['nome']; ?>">
                            <input type="hidden" name="resultado-panel" value="<?php echo $ln['resultado']; ?>">

                            <button class="btn btn-warning" style="border-radius: 20px;" type="submit"><span class="fa fa-pencil"></span></button>
                        </form>
	             </td>
                    </tr>
                <?php
                    }
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Valor</th>
		   <th>Ações</th>
                </tr>
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
        <!-- Fim Conteudo -->
        </section>
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
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Table -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
		$('#example1').DataTable( {
		  'paging'    : true,
		  'lengthChange': true,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : false,
		} );		
	} );
	
</script>

</body>
</html>
