<?php session_start();
require 'conexao.php'; 
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<body>
  <div id="columnchart_values" style="width: 1200px; height: 500px;"></div>
  <?php 
    $chart = '<div id="columnchart_values" style="width: 1200px; height: 500px;"></div>';
    $sql = $pdo->query("SELECT id, nome, resultado FROM colaborador ORDER BY resultado DESC");
  ?>
  
  //JsPDF
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
         <?php  
          if($sql->rowCount() > 0){
            $aux = 1;
            foreach ($sql->fetchAll() as $value) {
              $nome  = $value['nome'];
              $resultado = $value['resultado'];
        ?> 
          <?php if($aux <= 2): ?>     
            ['<?php echo $nome; ?>', <?php echo $resultado; ?>, "green"],
          <?php elseif($aux > 2 && $aux <= 4): ?>
            ['<?php echo $nome; ?>', <?php echo $resultado; ?>, "yellow"],
          <?php elseif($aux > 4): ?>
            ['<?php echo $nome; ?>', <?php echo $resultado; ?>, "red"],  
          <?php endif; ?>  
        <?php
            $aux++;
            }
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
        width: 1200,
        height: 500,
        bar: {groupWidth: "60%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }

    var doc = new jsPDF()
    doc.text(<?php echo $chart; ?>, 10, 10)
    doc.save('a4.pdf')
  </script>

</body>
</html>
