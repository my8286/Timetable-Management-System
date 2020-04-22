<?php
include('mpdf60/mpdf.php');
$mpdf=new mPDF();
$mpdf->WriteHTML('<p style="color:red;">Hallo World<br/>Fisrt sentencee</p>');
//$mpdf->Output();   exit;
 ?>