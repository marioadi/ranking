<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<script type="text/javascript">
var doc = new jsPDF()
doc.text('Hello world!', 10, 10)
doc.save('a4.pdf')
</script>

</body>
</html>

<?php
//session_start();
//require_once 'dompdf/autoload.inc.php';

//use Dompdf\Dompdf;

// instantiate and use the dompdf class
//$dompdf = new Dompdf();
//$chart = $_SESSION['grafic'];
//$dompdf->loadHtml($chart);

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
//$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();


?>
