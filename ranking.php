<?php session_start(); 
require 'conexao.php';
require 'usuario.class.php';
require 'colab.class.php';
$usuario = new Usuario();
$colab = new Colab();

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
  <title>C&A Ranking | Ranking PCJ</title>
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
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    @media print {
    body {
         visibility: hidden;
    }

    #columnchart_values {
         visibility: visible;
    }
    }
  </style>
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
        <li class="active">Ranking PCJ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
           
      <!-- Main row -->
      <div class="row">
        <section class="col-sm-12 connectedSortable">
        <!-- Inicio Conteudo -->
            <section class="content">
                <div class="row">
      					<div class="col-sm-12">
      						<div class="painel-botoes">
      							<a id="print" class="btn btn-primary">
      								<i class="fa fa-file-pdf-o"></i>
      								<span>Exporta PDF</span>
      							</a>
      						</div>
      					</div>
                  <div class="col-xs-12 table-responsive" style="overflow-y: hidden;">
                    
                    <div id="columnchart_values" style="width:1050px; height: 440px;"></div>
					
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
        <!-- Fim Conteudo -->
        </section>
        <div class="col-sm-12">
          <div class="painel-botoes">
              <a href="painel.php" class="btn btn-primary">
                  <i class="fa fa-angle-double-left"></i>
                  <span>Voltar</span>
              </a>
              <a href="cadastro-colaboradores.php" class="btn btn-success">
                  <i class="fa fa-plus"></i>
                  <span>Cadastrar</span>
              </a>
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


<?php 
  $sql = $pdo->query("SELECT id, nome, resultado FROM pcj ORDER BY resultado DESC");
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "R$", { role: "style" } ],
         <?php  
          if($sql->rowCount() > 0){
            $aux = 1;
            foreach ($sql->fetchAll() as $value) {
              $nome  = $value['nome'];
              $resultado = $value['resultado'];
        ?> 
          <?php if($aux <= 3): ?>     
            ['<?php echo $nome; ?>', <?php echo $resultado; ?>, "#31A952"],
          <?php elseif($aux > 3 && $aux <= 5): ?>
            ['<?php echo $nome; ?>', <?php echo $resultado; ?>, "#FBBE01"],
          <?php elseif($aux > 5): ?>
            ['<?php echo $nome; ?>', <?php echo $resultado; ?>, "#EB4132"],  
          <?php endif; ?>  
        <?php
            $aux++;
            }
          }else{
			['Não há resultado', 0, "#31A952"];
		  }
        ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
      { calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation" },
      2]);

      var options = {
        title: "Ranking PCJ",
        width: 1040,
        height: 460,
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  document.getElementById("print").onclick = function() {
    window.print();
  };
</script>
</body>
</html>

