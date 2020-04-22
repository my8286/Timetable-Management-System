
<?php

include('mpdf60/mpdf.php');
ob_start();  // start output buffering
include '../../pages/hodtabels/simple.php';
$content = ob_get_clean(); // get content of the buffer and clean the buffer
$mpdf = new mPDF(); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($content);
$mpdf->Output('result.pdf');

?>