<?php
session_start();
require 'error.php';
// include("mpdf/mpdf.php");
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf( [ 'tempDir' => __DIR__ . '/custom/temp/dir/path' ] );
// $mpdf->WriteHTML( 'Hello world!' );
// // $mpdf->OutputHttpDownload( 'download.pdf');
// $mpdf->Output();

// make the table in the variable by fetching the list of medicines from the global session

$table = '<table id="show-list-table">
<tr>
    <th>Sno.</th>
    <th>Non Generic name</th>
    <th>Generic name</th>
</tr>
<div id="added_list_items">
</div>
</table>';



$mpdf->WriteHTML();
$mpdf->Output( 'download.pdf', 'D' );

?>