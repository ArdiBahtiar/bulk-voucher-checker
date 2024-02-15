<?php
include('dbconfig.php');

$db = $conn;
$table_name = "input_db";
$columns = ['folio_id', 'issue_date', 'expired_date', 'PJ', 'Keterangan'];
$fetchdata = fetch_data($db, $table_name, $columns);
$truncate_data = mysqli_query($db, 'TRUNCATE TABLE `excel-sql`.`input_db`');

function fetch_data($db, $table_name, $columns)
{
    if(empty($db)){
        $msg= "Database connection error";
    }
        
    elseif (empty($columns) || !is_array($columns)) {
        $msg="columns Name must be defined in an indexed array";
    }
        
    else {
        $columnName = implode(", ", $columns);
        $datacheck = "SELECT * FROM input_db WHERE folio_id in (SELECT folio_id FROM pools_db)";
        $result = mysqli_query($db, $datacheck);
        // $validated = "SELECT * FROM `tbl_voucher` WHERE voucher_code = 0";
        // $result = mysqli_query($db, $validated);

        if($result== true){ 
            if (mysqli_num_rows($result) > 0) {
                $table_row= mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg= $table_row;
            } 

            else {
                $msg= "Belum ada yang di-Klaim"; 
            }
        }
            
        else{
            $msg= mysqli_error($db);
        }
    }
    return $msg;
}
?>