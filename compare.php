<?php
include('dbconfig.php');
$datacheck = "SELECT * FROM input_db WHERE folio_id in (SELECT folio_id FROM input_db)";
?>